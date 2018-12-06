<?php
namespace Sunanzhi\Api\Oauth;

use Sunanzhi\Service\Oauth\AuthServerInterface;
use Sunanzhi\Api\ApiClient;

class AuthServer implements AuthServerInterface
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
    public function getClientByClientKey(string $clientKey, string $clientSecret):array
    {
        return ApiClient::request('Oauth/Client', __FUNCTION__, $clientKey, $clientSecret);
    }
}