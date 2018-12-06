<?php
namespace Sunanzhi\Service\Oauth;

/**
 * 客户端接口
 */
interface  ClientInterface
{
    /**
     * 获取客户端对象
     *
     * @param string $clientKey 客户端key
     * @param string $clientSecret 客户端密钥
     * @return array
     * 
     * @author sunanzhi <sunanzhi@hotmail.com>
     */
    public function getClientByClientKey(string $clientKey, string $clientSecret):array;
}