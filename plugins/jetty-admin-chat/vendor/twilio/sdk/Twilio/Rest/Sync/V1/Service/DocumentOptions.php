<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Sync\V1\Service;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class DocumentOptions {
    /**
     * @param string $uniqueName The unique_name
     * @param array $data The data
     * @param integer $ttl The ttl
     * @return CreateDocumentOptions Options builder
     */
    public static function create($uniqueName = Values::NONE, $data = Values::NONE, $ttl = Values::NONE) {
        return new CreateDocumentOptions($uniqueName, $data, $ttl);
    }

    /**
     * @param array $data The data
     * @param integer $ttl The ttl
     * @return UpdateDocumentOptions Options builder
     */
    public static function update($data = Values::NONE, $ttl = Values::NONE) {
        return new UpdateDocumentOptions($data, $ttl);
    }
}

class CreateDocumentOptions extends Options {
    /**
     * @param string $uniqueName The unique_name
     * @param array $data The data
     * @param integer $ttl The ttl
     */
    public function __construct($uniqueName = Values::NONE, $data = Values::NONE, $ttl = Values::NONE) {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['data'] = $data;
        $this->options['ttl'] = $ttl;
    }

    /**
     * The unique_name
     * 
     * @param string $uniqueName The unique_name
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName) {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * The data
     * 
     * @param array $data The data
     * @return $this Fluent Builder
     */
    public function setData($data) {
        $this->options['data'] = $data;
        return $this;
    }

    /**
     * The ttl
     * 
     * @param integer $ttl The ttl
     * @return $this Fluent Builder
     */
    public function setTtl($ttl) {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Sync.V1.CreateDocumentOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateDocumentOptions extends Options {
    /**
     * @param array $data The data
     * @param integer $ttl The ttl
     */
    public function __construct($data = Values::NONE, $ttl = Values::NONE) {
        $this->options['data'] = $data;
        $this->options['ttl'] = $ttl;
    }

    /**
     * The data
     * 
     * @param array $data The data
     * @return $this Fluent Builder
     */
    public function setData($data) {
        $this->options['data'] = $data;
        return $this;
    }

    /**
     * The ttl
     * 
     * @param integer $ttl The ttl
     * @return $this Fluent Builder
     */
    public function setTtl($ttl) {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Sync.V1.UpdateDocumentOptions ' . implode(' ', $options) . ']';
    }
}