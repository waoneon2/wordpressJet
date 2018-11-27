<?php

namespace TextOperation\Document;

use TextOperation\TextOperation;

class MemoryBackend implements DocumentBackend
{
    /**
     * @var TextOperation[]
     */
    protected $operations;

    protected $lastOperation;

    protected $document;

    public function __construct($document, array $operation = [])
    {
        $this->document = $document;
        $this->lastOperation = [];
        $this->setOperation($operation);
    }

    public function get($id)
    {
        return $this->document;
    }

    public function save($id, $doc)
    {
        $this->document = $doc;
    }

    public function saveOperation($userid, $id, TextOperation $operation)
    {
        $this->lastOperation[$userid] = count($this->operations);
        $this->operations[] = $operation;
    }

    public function deleteOperations($id)
    {
        $this->operations = [];
        $this->lastOperation = [];
    }

    public function getOperations($id, $start, $end = null)
    {
        $operations = $this->operations;
        if ($end === null) {
            $length = count($operations);
        } elseif ($end >= 0 && $end <= $start) {
            return [];
        } elseif ($end < 0) {
            $length = count($operations) + $end - $start;
        } else {
            $length = $end - $start;
        }

        return array_slice($operations, $start, $length);
    }

    public function getLastRevisionfromUser($userid, $id)
    {
        return isset($this->lastOperation[$userid]) ? $this->lastOperation[$userid] : null;
    }

    protected function setOperation($operations)
    {
        $ops = [];
        foreach ($operations as $op) {
            if (!$op instanceof TextOperation) {
                throw new \InvalidArgumentException('operation array must be an array of text operation');
            }
            $ops[] = $op;
        }
        $this->operations = $ops;
    }
}
