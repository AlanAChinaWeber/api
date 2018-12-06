<?php
namespace Sunanzhi\Api\User;

use Sunanzhi\Service\User\UserInterface;
use Sunanzhi\Api\ApiClient;

class User implements UserInterface
{
    public function getUserByUsernameAndPassword(string $username, string $password): array
    {
        return ApiClient::request('User/User', __FUNCTION__, $username, $password);
    }
}
