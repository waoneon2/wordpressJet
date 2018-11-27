<?php

namespace TextOperation;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use TextOperation\Exception\IncompatibleException;

class TextOperation implements Countable, IteratorAggregate, JsonSerializable
{
    /**
     * The array of operation, it element can contains string and integer.
     *
     * @var arrray
     */
    protected $ops = [];

    /**
     * Create new TextOperation
     * @param array $ops The operation
     */
    public function __construct($ops = [])
    {
        $this->ops = $ops;
    }

    /**
     * Countable implementation.
     *
     * @return int The count of operations
     */
    public function count()
    {
        return count($this->ops);
    }

    /**
     * JsonSerializable implementation to allow use serialize this instance directly
     * to JSON.
     */
    public function jsonSerialize()
    {
        return $this->ops;
    }

    /**
     * getIterator.
     *
     * @return \Iterator Iterator to iterate current operations available
     */
    public function getIterator()
    {
        return new ArrayIterator($this->ops);
    }

    public function equals($other)
    {
        return $other instanceof self && $other->ops === $this->ops;
    }

    /**
     * Returns the difference in length between the input and the output string when
     * this operations is applied.
     *
     * @return int
     */
    public function lenDifference()
    {
        $s = 0;
        foreach ($this as $op) {
            if (is_string($op)) {
                $s += mb_strlen($op, 'UTF-8');
            } elseif ($op < 0) {
                $s += $op;
            }
        }

        return $s;
    }

    /**
     * Skips a given number of characters at the current cursor position.
     *
     * @param int $r number to skip
     *
     * @return self
     */
    public function retain($r)
    {
        if ($r === 0) {
            return $this;
        }
        $len = count($this);
        if ($len > 0 && is_int($this->ops[$len - 1]) && $this->ops[$len - 1] > 0) {
            $this->ops[$len - 1] = $this->ops[$len - 1] + $r;
        } else {
            $this->ops[] = $r;
        }

        return $this;
    }

    public function insert($s)
    {
        if (mb_strlen($s) === 0) {
            return $this;
        }
        $len = count($this);
        if ($len > 0 && is_string($this->ops[$len - 1])) {
            $this->ops[$len - 1] = $this->ops[$len - 1].$s;
        } elseif ($len > 0 && is_int($this->ops[$len - 1]) && $this->ops[$len - 1] < 0) {
            if ($len > 1 && is_string($this->ops[$len - 2])) {
                $this->ops[$len - 2] = $this->ops[$len - 2].$s;
            } else {
                $this->ops[] = $this->ops[$len - 1];
                $this->ops[count($this) - 2] = $s;
            }
        } else {
            $this->ops[] = $s;
        }

        return $this;
    }

    public function delete($d)
    {
        if ($d === 0) {
            return $this;
        }
        if ($d > 0) {
            $d = -$d;
        }
        $len = count($this);
        if ($len > 0 && is_int($this->ops[$len - 1]) && $this->ops[$len - 1] < 0) {
            $this->ops[$len - 1] = $this->ops[$len - 1] + $d;
        } else {
            $this->ops[] = $d;
        }

        return $this;
    }

    public function apply($doc)
    {
        $i = 0;
        $parts = [];
        foreach ($this as $op) {
            if (is_retain($op)) {
                if (($i + $op) > mb_strlen($doc, 'UTF-8')) {
                    throw new IncompatibleException('Cannot apply operation: operation is too long.');
                }
                $parts[] = string_slice($doc, $i, $i + $op);
                $i += $op;
            } elseif (is_insert($op)) {
                $parts[] = $op;
            } else {
                $i -= $op;
                if ($i > mb_strlen($doc, 'UTF-8')) {
                    throw new IncompatibleException('Cannot apply operation: operation is too long.');
                }
            }
        }
        if ($i !== mb_strlen($doc, 'UTF-8')) {
            throw new IncompatibleException(
                sprintf(
                    'Cannot apply operation: operation is too short. %s %d and %d', implode(':', $this->ops), $i, mb_strlen($doc, 'UTF-8')));
        }

        return implode('', $parts);
    }

    public function invert($doc)
    {
        $i = 0;
        $inverse = new self();
        foreach ($this as $op) {
            if (is_retain($op)) {
                $inverse->retain($op);
                $i += $op;
            } elseif (is_insert($op)) {
                $inverse->delete(mb_strlen($op, 'UTF-8'));
            } else {
                $inverse->insert(string_slice($doc, $i, $i - $op));
                $i -= $op;
            }
        }

        return $inverse;
    }

    public function compose(TextOperation $other)
    {
        $iter_a = iter($this);
        $iter_b = iter($other);

        $operation = new self();
        $a = $b = null;
        $sentinel = new \stdClass();
        while (true) {
            if ($a === null) {
                $a = forward($iter_a, $sentinel);
                if ($a === $sentinel) {
                    $a = null;
                }
            }
            if ($b === null) {
                $b = forward($iter_b, $sentinel);
                if ($b === $sentinel) {
                    $b = null;
                }
            }
            if ($a === null && $b === null) {
                break;
            }
            if (is_delete($a)) {
                $operation->delete($a);
                $a = null;
                continue;
            }
            if (is_insert($b)) {
                $operation->insert($b);
                $b = null;
                continue;
            }
            if ($a === null) {
                throw new IncompatibleException('Cannot compose operations: first operation is too short');
            }
            if ($b === null) {
                throw new IncompatibleException('Cannot compose operations: first operation is too long');
            }
            $min_len = min(oplength($a), oplength($b));
            if (is_retain($a) && is_retain($b)) {
                $operation->retain($min_len);
            } elseif (is_insert($a) && is_retain($b)) {
                $operation->insert(string_slice($a, 0, $min_len));
            } elseif (is_retain($a) && is_delete($b)) {
                $operation->delete($min_len);
            }
            list($a, $b) = opshorten_pair($a, $b);
        }

        return $operation;
    }

    public static function transform(TextOperation $operation_a, TextOperation $operation_b)
    {
        $iter_a = iter($operation_a);
        $iter_b = iter($operation_b);

        $a_prime = new self();
        $b_prime = new self();
        $a = $b = null;
        $sentinel = new \stdClass();
        while (true) {
            if ($a === null) {
                $a = forward($iter_a, $sentinel);
                if ($a === $sentinel) {
                    $a = null;
                }
            }
            if ($b === null) {
                $b = forward($iter_b, $sentinel);
                if ($b === $sentinel) {
                    $b = null;
                }
            }
            if ($a === null && $b === null) {
                break;
            }
            if (is_insert($a)) {
                $a_prime->insert($a);
                $b_prime->retain(mb_strlen($a, 'UTF-8'));
                $a = null;
                continue;
            }
            if (is_insert($b)) {
                $a_prime->retain(mb_strlen($b, 'UTF-8'));
                $b_prime->insert($b);
                $b = null;
                continue;
            }
            if ($a === null) {
                throw new IncompatibleException('Cannot transform operations: first operation is too short');
            }
            if ($b === null) {
                throw new IncompatibleException('Cannot transform operations: first operation is too long');
            }
            $min_len = min(oplength($a), oplength($b));
            if (is_retain($a) && is_retain($b)) {
                $a_prime->retain($min_len);
                $b_prime->retain($min_len);
            } elseif (is_delete($a) && is_retain($b)) {
                $a_prime->delete($min_len);
            } elseif (is_retain($a) && is_delete($b)) {
                $b_prime->delete($min_len);
            }
            list($a, $b) = opshorten_pair($a, $b);
        }

        return [$a_prime, $b_prime];
    }
}
