<?php
namespace Sunanzhi\Service\Demo;

interface DemoInterface
{
    public function demo(bool $check):bool;

    public function test(string $str):string;
}