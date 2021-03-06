<?php

namespace TextOperation;

/**
 * The format of Operational Transformation like this:
 * 1. If the type is string then it Insert operation
 * 2. If the type is integer and it greater than 0 then it Retain
 * 3. Otherwise it Delete operation (integer and less than 0).
 *
 * @param mixed $s
 */
function is_retain($s)
{
    return is_int($s) && $s > 0;
}

function is_delete($s)
{
    return is_int($s) && $s < 0;
}

function is_insert($s)
{
    return is_string($s);
}

function oplength($s)
{
    if (is_int($s)) {
        if ($s < 0) {
            return -$s;
        }

        return $s;
    }

    return mb_strlen($s, 'UTF-8');
}

function opshorten($op, $by)
{
    if (is_string($op)) {
        return mb_substr($op, $by, 'UTF-8');
    }
    if ($op < 0) {
        return $op + $by;
    }

    return $op - $by;
}

function opshorten_pair($a, $b)
{
    $len_a = oplength($a);
    $len_b = oplength($b);

    if ($len_a === $len_b) {
        return [null, null];
    }
    if ($len_a > $len_b) {
        return [opshorten($a, $len_b), null];
    }

    return [null, opshorten($b, $len_a)];
}

function opFromJSON($json)
{
    $ops = json_decode($json);

    return new TextOperation($ops);
}

function iter($iterable)
{
    if ($iterable instanceof \Iterator) {
        return $iterable;
    }
    if ($iterable instanceof \IteratorAggregate) {
        return $iterable->getIterator();
    }
    if (is_array($iterable)) {
        return new \ArrayIterator($iterable);
    }
    throw new \InvalidArgumentException('Argument must be iterable');
}

function forward($iterator, $default = null)
{
    if (!$iterator instanceof \Iterator) {
        throw new \InvalidArgumentException(sprintf(
            'Argument 1 must be an iterator, %s give', gettype($iterator)
        ));
    }
    if ($iterator->valid()) {
        $value = $iterator->current();
        $iterator->next();

        return $value;
    }
    if ($default !== null) {
        return $default;
    }
    throw new \RuntimeException(sprintf(
        '%s iterator no longer valid to iterate',
        get_class($iterator)
    ));
}

function string_slice($string, $start, $end = null)
{
    if ($end === null) {
        $length = mb_strlen($string, 'UTF-8');
    } elseif ($end >= 0 && $end <= $start) {
        return '';
    } elseif ($end < 0) {
        $length = mb_strlen($string, 'UTF-8') + $end - $start;
    } else {
        $length = $end - $start;
    }

    return mb_substr($string, $start, $length, 'UTF-8');
}

function random_str($length = 16)
{
    $string = '';
    while (($len = strlen($string)) < $length) {
        $size = $length - $len;
        $bytes = random_bytes($size);
        $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
    }

    return $string;
}
