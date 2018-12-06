<?php
namespace Sunanzhi\Service\User;

/**
 * 用户接口
 */
interface UserInterface
{
    /**
     * 通过用户名和用户密码获取用户基本信息
     *
     * @param string $username 用户姓名
     * @param string $password 用户密码
     * @return array
     * 
     * @author sunanzhi <sunanzhi@hotmail.com>
     */
    public function getUserByUsernameAndPassword(string $username, string $password):array;
}