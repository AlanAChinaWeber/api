<?php
namespace Sunanzhi\Api\Oauth;

use Sunanzhi\Service\Oauth\AuthServerInterface;
use Sunanzhi\Api\ApiClient;

class AuthServer implements AuthServerInterface
{
    public function getAccessToken(): array
    {
        return ApiClient::request('Oauth/AuthServer', __FUNCTION__);
    }
}