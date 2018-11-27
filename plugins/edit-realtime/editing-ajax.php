<?php

use TextOperation\DefaultServerWorker;
use TextOperation\Document\WPEditingContent;
use TextOperation\Document\WPEditingTitle;
use TextOperation\Exception\IncompatibleException;
use TextOperation\TextOperation;

function jte_ajax_receive_content_operation()
{
    $post_id = (int) $_POST['post_id'];
    $opt = json_decode(wp_unslash($_POST['operation']));
    $operation = new TextOperation($opt);
    $revision = (int) $_POST['revision'];
    $userid = $_POST['user_id'];
    $doc = new WPEditingContent();
    $server = new DefaultServerWorker($doc);
    try {
        $res = $server->receiveOperation($userid, $post_id, $revision, $operation);
        $options = [
            'encrypted' => true,
        ];
        $pusher = new Pusher(
            'a93b916c848e1743e492',
            '6382dcd60b3487bafe22',
            '313687',
            $options
        );
        $data = [];
        $data['operation'] = $res instanceof Traversable ? iterator_to_array($res) : [];
        $data['user_id'] = $userid;
        $data['post_id'] = $post_id;
        $pusher->trigger("presence-jte-operation-post-editing-$post_id", 'operation-content', $data);
        wp_send_json([
            'success' => true,
            'operation' => $res,
        ]);
    } catch (IncompatibleException $e) {
        wp_send_json([
            'success' => false,
            'content' => $doc->get($post_id),
            'message' => $e->getMessage(),
        ]);
    }
}
add_filter('wp_ajax_jte_ajax_receive_content_operation', 'jte_ajax_receive_content_operation', 10, 2);

function jte_ajax_delete_content_operation()
{
    $post_id = (int) $_POST['post_id'];
    $doc = new WPEditingContent();
    $doc->deleteOperations($post_id);
    wp_send_json([
        'success' => true,
        'revision' => 0
    ]);
}
add_filter('wp_ajax_jte_ajax_delete_content_operation', 'jte_ajax_delete_content_operation', 10, 2);

function jte_ajax_receive_title_operation()
{
    $post_id = (int) $_POST['post_id'];
    $opt = json_decode(wp_unslash($_POST['operation']));
    $operation = new TextOperation($opt);
    $revision = (int) $_POST['revision'];
    $userid = $_POST['user_id'];

    $doc = new WPEditingTitle();
    $server = new DefaultServerWorker($doc);

    try {
        $res = $server->receiveOperation($userid, $post_id, $revision, $operation);
        $options = [
            'encrypted' => true,
        ];
        $pusher = new Pusher(
            'a93b916c848e1743e492',
            '6382dcd60b3487bafe22',
            '313687',
            $options
        );
        $data = [];
        $data['operation'] = $res instanceof Traversable ? iterator_to_array($res) : [];
        $data['user_id'] = $userid;
        $data['post_id'] = $post_id;
        $pusher->trigger("presence-jte-operation-post-editing-$post_id", 'operation-title', $data);
        wp_send_json([
            'success' => true,
            'operation' => $res,
        ]);
    } catch(IncompatibleException $e) {
        wp_send_json([
            'success' => false,
            'content' => $doc->get($post_id),
            'message' => $e->getMessage(),
        ]);
    }
}

add_filter('wp_ajax_jte_ajax_receive_title_operation', 'jte_ajax_receive_title_operation', 10, 2);

function jte_ajax_delete_title_operation()
{
    $post_id = (int) $_POST['post_id'];
    $doc = new WPEditingTitle();
    $doc->deleteOperations($post_id);
    wp_send_json([
        'success' => true,
        'revision' => 0
    ]);
}
add_filter('wp_ajax_jte_ajax_delete_title_operation', 'jte_ajax_delete_title_operation', 10, 2);

function jte_ajax_ask_current_post_info()
{
    $post_id = (int) $_GET['post_id'];
    $po = new WPEditingContent();
    $to = new WPEditingTitle();
    $content = $po->get($post_id);
    wp_send_json([
        'content' => $content,
        'content_len' => mb_strlen($content, 'UTF-8'),
        'title' => $to->get($post_id),
        'post_id' => $post_id,
        'revision_content' => count($po->getOperations($post_id, 0)),
        'revision_title' => count($to->getOperations($post_id, 0)),
        'timestamp' => time(),
    ]);
}
add_filter('wp_ajax_jte_ajax_ask_current_post_info', 'jte_ajax_ask_current_post_info', 10, 2);