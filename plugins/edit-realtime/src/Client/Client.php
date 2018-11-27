<?php

namespace TextOperation\Client;

use TextOperation\TextOperation;

/**
 * Handles the client part of the OT synchronization protocol. Transforms
 * incoming operations from the server, buffers operations from the user and
 * sends them to the server at the right time.
 */
abstract class Client
{
    /**
     * Revision version of operation.
     *
     * @var int
     */
    protected $revision;

    /**
     * @var TextOperation\Client\ClientState
     */
    protected $state;

    /**
     * create new Client.
     *
     * @param mixed $revision
     */
    public function __construct($revision)
    {
        $this->revision = $revision;
        $this->state = new Synchronized();
    }

    /**
     * Call this method when the user (!) changes the document.
     */
    public function applyClient(TextOperation $operation)
    {
        $this->state = $this->state->applyClient($this, $operation);
    }

    /**
     * Call this method with a new operation from the server.
     */
    public function applyServer(TextOperation $operation)
    {
        $this->revision += 1;
        $this->state = $this->state->applyServer($this, $operation);
    }

    /**
     * Call this method when the server acknowledges an operation send by
     * the current user (via the send_operation method).
     */
    public function serverAck()
    {
        $this->revision += 1;
        $this->state = $this->state->serverAck($this);
    }

    /**
     * Get current revision.
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * Send operation to server.
     *
     * @param int                         $revision  revison number for operation
     * @param TextOperation\TextOperation $operation operation to send to server
     */
    abstract public function sendOperation($revision, TextOperation $operation);

    /**
     * Apply the operation against this client. It maybe applied to a document.
     *
     * @param TextOperation\TextOperation $operation
     */
    abstract public function applyOperation(TextOperation $operation);
}
