<?php
namespace Sunanzhi\Service\Oauth;

/**
 * 授权接口
 */
interface AuthServerInterface
{
    /**
     * 获取授权
     *
     * @return array
     * 
     * @author sunanzhi <sunanzhi@hotmail.com>
     * @since 2018.11.10
     */
    public function getAccessToken():array;
}