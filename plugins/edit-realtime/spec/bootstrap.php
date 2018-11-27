<?php

namespace TextOperation\Test;

use TextOperation\TextOperation;

require __DIR__.'/../vendor/autoload.php';

function random_char()
{
    return chr(random_int(97, 123));
}

function random_string($max_len = 16)
{
    $s = '';
    $s_len = random_int(0, $max_len);
    while ($s_len > 0) {
        $s .= random_char();
        $s_len -= 1;
    }

    return $s;
}

function random_operation($doc)
{
    $op = new TextOperation();
    $i = 0;
    $gen_retain = function ($max_len) use ($op) {
        $r = random_int(1, $max_len);
        $op->retain($r);

        return $r;
    };
    $gen_insert = function () use ($op) {
        $op->insert(random_char().random_string(9));

        return 0;
    };
    $gen_delete = function ($max_len) use ($op) {
        $d = random_int(1, $max_len);
        $op->delete($d);

        return $d;
    };
    $len = mb_strlen($doc);
    $gens = [$gen_retain, $gen_delete, $gen_insert];
    while ($i < $len) {
        $max_len = min(10, $len - $i);
        $k = array_rand($gens);
        $i += call_user_func($gens[$k], $max_len);
    }

    return $op;
}
