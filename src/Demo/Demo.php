<?php
namespace Sunanzhi\Api\Demo;

class Demo
{
    public function demo(bool $check):bool
    {
        return $check;
    }

    public function test(string $str):string
    {
        return 'hello '.$str;
    }
}