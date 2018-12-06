<?php
namespace Sunanzhi\Service\Demo;

interface DemoInterface
{
    /**
     * 测试案例
     *
     * @param integer $start 参数1
     * @param integer $count 参数2
     * @return array
     * 
     * @author sunanzhi <sunanzhi@hotmail.com>
     * @since 2018.10.20
     */
    public function test(int $start = 0, int $count = 5):array;
}