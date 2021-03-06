<?php

namespace TextOperation\Document;

use TextOperation\TextOperation;

/**
 * Used to log/persist operations.
 */
interface DocumentBackend
{
    /**
     * Save document.
     *
     * @param mixed $id
     * @param mixed $doc
     */
    public function save($id, $doc);

    /**
     * Get document by Id.
     *
     * @param mixed $id
     *
     * @return string
     */
    public function get($id);

    /**
     * Save an operation in the database.
     *
     * @param mixed $userid The id identifier for user
     * @param mixed $id     The id of document
     * @param TextOperation\TextOperation The operation mad by user
     */
    public function saveOperation($userid, $id, TextOperation $operation);

    /**
     * Return operations in a given range.
     *
     * @param int      $id    The start
     * @param int      $start The start range
     * @param int|null $end   Optional end range
     *
     * @return TextOperation\TextOperation[] Return an array of TextOperation
     */
    public function getOperations($id, $start, $end = null);

    /**
     * Delete operations from this backend
     *
     * @param mixin $id
     * @return void
     */
    public function deleteOperations($id);

    /**
     * Return the revision number of the last operation from a given user and document
     * id.
     *
     * @param mixed $userid The id of user
     * @param mixed $id     The id of document
     *
     * @return TextOperation\TextOperation[] Return an array of TextOperation
     */
    public function getLastRevisionfromUser($userid, $id);
}
