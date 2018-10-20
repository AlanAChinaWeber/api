<?php
namespace Sunanzhi\Api\Demo;

use Sunanzhi\Service\Demo\DemoInterface;
use Sunanzhi\Api\ApiClient;

class Demo implements DemoInterface
{
    public function test(int $start = 0, int $count = 5):array
    {
        return ApiClient::request('Demo/Demo', __FUNCTION__, $start, $count);
    }
}