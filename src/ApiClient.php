<?php
namespace Sunanzhi\Api;

use EasySwoole\Config;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

/**
 * 请求api入口
 */
class ApiClient
{

    /**
     * 请求接口
     *
     * @param string $url 请求接口路径
     * @param string $method 请求接口方法
     * @param mixed ...$args 参数
     * @return mixed
     * 
     * @author sunanzhi <sunanzhi@hotmail.com>
     * @since 2018.10.16
     */
    public static function request(string $url, string $method, ...$args)
    {
        // 获取请求模块
        $module = strtolower(explode('/', $url)[0]);
        // 获取模块
        $domain = Config::getInstance()->getConf('PROVIDERURL.'.$module);
        // 拼接请求接口 url
        $url = $module.'/'.$url.'/'.$method;
        // 参数封装
        $paramArr = self::packageArgs($args);
        // 请求
        return self::guzzleRequest($url, $paramArr);   
    }

    /**
     * 封装参数
     *
     * @param mixed ...$agrs 请求的参数
     * @return mixed
     * 
     * @author sunanzhi <sunanzhi@hotmail.com>
     * @since 2018.10.16
     */
    private static function packageArgs(...$agrs):array
    {
        if(is_array($agrs)){
            // 多参数
            foreach($args as $v){
                $res["$v"] = $v;
            }
        }else if(!$args){
            // 没有参数
            $res = [];
        }else{
            $res = ["$args" => $args];
        }
        return $res;
    }

    /**
     * 发送请求
     *
     * @param string $url 请求url
     * @param array $args 请求参数
     * @return mixed
     * 
     * @author sunanzhi <sunanzhi@hotmail.com>
     * @since 2018.10.16
     */
    private static function guzzleRequest(string $url, array $args)
    {
        $guzzleClient = new Client();

        $response = $guzzleClient->request('POST', $url, $args);

        $content = (string)$response->getBody();
        $object = null;
        if('' != $content){
            $object = json_decode($response, true);
        }
        
        return $object;
    }

}