<?php

namespace TextOperation\Websocket;

use TextOperation\ServerWorker;
use TextOperation\TextOperation;
use Wrench\Application\Application;

class OperationalTransformation extends Application
{
    /**
     * @var
     */
    protected $clients = [];

    /**
     * @var TextOperation\ServerWorker
     */
    protected $adapter;

    public function __construct(ServerWorker $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @see Wrench\Application.Application::onConnect()
     *
     * @param mixed $client
     */
    public function onConnect($client)
    {
        $this->clients[] = $client;
        // then broadcast?
    }

    public function onData($payload, $client)
    {
        $data = json_decode((string) $payload, true);
        switch ($data['type']) {
            case 'operation':
                $this->onOperation($data, $client);
                break;
            case 'join':
                // user join editing this editor
                $this->onUserJoin($data, $client);
                break;
            default:
                break;
        }
    }

    protected function onUserJoin($data, $client)
    {
        $id = $client->getId();
        $client->send(json_encode([
            'socket_id' => $id,
        ]));
    }

    protected function onOperation($data, $client)
    {
        $op = new TextOperation($data['operation']);
        $operation = $this->adapter->receiveOperation(
            $data['user_id'], $data['post_id'], $data['revision'], $op);
        $client->send(json_encode([
            'type' => 'ack',
        ]));
        foreach ($this->client as $broadcast) {
            if ($broadcast !== $client) {
                $broadcast->send(json_encode([
                    'type' => 'operation',
                    'user_id' => $data['user_id'],
                    'operation' => $operation,
                    'post_id' => $data['post_id'],
                ]));
            }
        }
    }
}
