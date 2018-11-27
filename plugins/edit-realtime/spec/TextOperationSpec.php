<?php

namespace TextOperation\Test;

use TextOperation\TextOperation;

describe('TextOperation', function () {
    it('Append operations', function () {
        $op = new TextOperation();
        $op->delete(0);
        $op->insert('lorem');
        $op->retain(0);
        $op->insert(' ipsum');
        $op->retain(3);
        $op->retain('');
        $op->retain(5);
        $op->delete(8);

        expect(count($op))->toEqual(3);
        expect(iterator_to_array($op))->toEqual(['lorem ipsum', 8, -8]);
    });

    it('Correctly compute length diff', function () {
        $doc = random_string(50);
        $operation = random_operation($doc);
        $diff = mb_strlen($operation->apply($doc)) - mb_strlen($doc);
        expect($operation->lenDifference())->toEqual($diff);
    });

    it('Can apply operations against text', function () {
        $op = new TextOperation();
        $op->delete(1)
           ->insert('l')
           ->retain(4)
           ->delete(4)
           ->retain(2)
           ->insert('s');
        expect($op->apply('Lorem ipsum'))->toEqual('loremums');
    });

    it('Can invert operations.', function () {
        $doc = random_string(50);
        $operation = random_operation($doc);
        $inverse = $operation->invert($doc);
        expect($inverse->apply($operation->apply($doc)))->toEqual($doc);
    });

    it('Composable', function () {
        $doc = random_string(50);
        $a = random_operation($doc);
        $doc_a = $a->apply($doc);
        $b = random_operation($doc_a);
        $ab = $a->compose($b);
        expect($b->apply($doc_a))->toEqual($ab->apply($doc));
    });

    it('Transform two operations a and b to a\' and b\' ', function () {
        $doc = random_string(50);
        $a = random_operation($doc);
        $b = random_operation($doc);
        list($a_prime, $b_prime) = TextOperation::transform($a, $b);

        $a1 = ($a->compose($b_prime))->equals($b->compose($a_prime));
        expect($a1)->toBe(true);

        $doc_a = $a_prime->apply($b->apply($doc));
        $doc_b = $b_prime->apply($a->apply($doc));
        expect($doc_a)->toEqual($doc_b);
    });
});
