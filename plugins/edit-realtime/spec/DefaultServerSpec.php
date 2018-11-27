<?php

namespace TextOperation\Test;

use TextOperation\DefaultServerWorker;
use TextOperation\Document\MemoryBackend;
use TextOperation\TextOperation;

describe('Default Server Worker', function () {
    it('return correct operation transformation', function () {
        $document = random_string(50);
        $backend = new MemoryBackend($document);
        $server = new DefaultServerWorker($backend);
        $op1 = random_operation($document);
        $doc1 = $op1->apply($document);

        $ret = $server->receiveOperation('user1', 'doc1', 0, $op1);
        expect($op1->equals($ret))->toBe(true);
        expect($backend->get('doc1'))->toEqual($doc1);
    });

    it('apply op async', function () {
        $document = random_string(50);
        $backend = new MemoryBackend($document);
        $server = new DefaultServerWorker($backend);

        $op1 = random_operation($document);
        $doc1 = $op1->apply($document);
        $server->receiveOperation('user1', 'doc1', 0, $op1);

        $op2 = random_operation($doc1);
        $doc2 = $op2->apply($doc1);
        $ret = $server->receiveOperation('user1', 'doc1', 1, $op2);
        expect($op2->equals($ret))->toBe(true);

        $ops = $backend->getOperations('doc1', 0);
        expect(count($ops))->toEqual(2);
        expect($ops[0]->equals($op1))->toBe(true);
        expect($ops[1]->equals($op2))->toBe(true);

        expect($backend->get('doc1'))->toEqual($doc2);

        $op2_b = random_operation($doc1);
        list($op2_b_p, $op2_p) = TextOperation::transform($op2_b, $op2);
        $ret_b = $server->receiveOperation('user2', 'doc1', 1, $op2_b);
        expect($ret_b->equals($op2_b_p))->toBe(true);

        $ops = $backend->getOperations('doc1', 0);
        expect(count($ops))->toEqual(3);
        expect($ops[2]->equals($op2_b_p))->toBe(true);

        $expdoc = $op2_p->apply($op2_b->apply($doc1));
        expect($backend->get('doc1'))->toEqual($expdoc);
    });
});
