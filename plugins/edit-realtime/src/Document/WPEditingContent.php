<?php

namespace TextOperation\Document;

use TextOperation\TextOperation;

class WPEditingContent implements DocumentBackend
{
    public function save($id, $doc)
    {
        $editing = jte_get_post_first_editing($id);
        $post = get_object_vars(get_post($id, OBJECT));
        $fields = _jte_post_editing_fields($post);
        $fields['ID'] = $editing->ID;
        $fields['post_content'] = $doc;

        wp_update_post($fields);
    }

    public function get($id)
    {
        $editing = jte_get_post_first_editing($id);

        return $editing->post_content;
    }

    public function saveOperation($userid, $id, TextOperation $operation)
    {
        $operations = get_post_meta($id, '_jte_text_operations', true);
        $lastOperation = get_post_meta($id, '_jte_text_last_operations', true);
        if (!is_array($operations)) {
            $operations = [];
        }
        $v = count($operations);
        $lastOperation[$userid] = $v;
        $operations[] = iterator_to_array($operation);
        update_post_meta($id, '_jte_text_operations', $operations);
        update_post_meta($id, '_jte_text_last_operations', $lastOperation);
    }

    public function deleteOperations($id)
    {
        update_post_meta($id, '_jte_text_operations', []);
        update_post_meta($id, '_jte_text_last_operations', []);
    }

    public function getOperations($id, $start, $end = null)
    {
        $operations = get_post_meta($id, '_jte_text_operations', true);
        if (!is_array($operations)) {
            $operations = [];
        }
        if ($end === null) {
            $length = count($operations);
        } elseif ($end >= 0 && $end <= $start) {
            return [];
        } elseif ($end < 0) {
            $length = count($operations) + $end - $start;
        } else {
            $length = $end - $start;
        }
        $sliced = array_slice($operations, $start, $length);

        return array_map(function ($op) {
            return new TextOperation($op);
        }, $sliced);
    }

    public function getLastRevisionfromUser($userid, $id)
    {
        $lastOperation = get_post_meta($id, '_jte_text_last_operations', true);

        return isset($lastOperation[$userid]) ? $lastOperation[$userid] : null;
    }
}
