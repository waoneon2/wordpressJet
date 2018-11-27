<?php

namespace TextOperation;

use TextOperation\Document\DocumentBackend;

class DefaultServerWorker implements ServerWorker
{
    /**
     * @var TextOperation\ServerBackend
     */
    protected $backend;

    /**
     * constructor. Create DefaultServerWorker with initial document and ServerBackend
     * instance (used when save the operation).
     *
     * @var string
     * @var TextOperation\Document\DocumentBackend $backend
     *
     * @param mixed $document
     */
    public function __construct(DocumentBackend $backend)
    {
        $this->backend = $backend;
    }

    /**
     * Transforms an operation coming from a client against all concurrent
     * operation, applies it to the current document and returns the operation
     * to send to the clients.
     *
     * @param mixed $user_id
     * @param mixed $docid
     * @param mixed $revision
     * @param mixed $operation
     */
    public function receiveOperation($user_id, $docid, $revision, $operation)
    {
        $lastByUser = $this->backend->getLastRevisionfromUser($user_id, $docid);
        if ($lastByUser !== null && $lastByUser >= $revision) {
            return;
        }
        $concurrent_operations = $this->backend->getOperations($docid, $revision);
        foreach ($concurrent_operations as $concurrent_operation) {
            list($_operation, $_s) = TextOperation::transform($operation, $concurrent_operation);
            $operation = $_operation;
        }
        $document = $operation->apply($this->backend->get($docid));
        $this->backend->save($docid, $document);
        $this->backend->saveOperation($user_id, $docid, $operation);

        return $operation;
    }
}
