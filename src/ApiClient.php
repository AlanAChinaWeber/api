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
        // 当前命名空间
        $namespace = (new \ReflectionClass(__CLASS__))->getNamespaceName();
        // 获取模块
        $urlExplode = explode('/', $url);
        $module = $urlExplode[0];
        $moduleClass = $urlExplode[1];

        // 获取接口参数
        $apiParams = array_column((new \ReflectionMethod($namespace.'\\'.$module.'\\'.$moduleClass, $method))->getParameters(), 'name');
        // 封装请求参数
        $requestParams = self::packageArgs($apiParams, $args);
        // 获取请求url
        $apiUrl = Config::getInstance()->getConf('PROVIDERURL.'.$module).'\\'.$module.'\\'.$moduleClass.'\\'.$method;

        return self::guzzleRequest($apiUrl, $requestParams);  
    }

    /**
     * 封装参数
     *
     * @param array $apiParams 接口参数
     * @param array $args 请求的参数
     * @return mixed
     * 
     * @author sunanzhi <sunanzhi@hotmail.com>
     * @since 2018.10.16
     */
    private static function packageArgs(array $apiParams, array $args):array
    {
        $resParams = [];
        $i = 0;
        foreach($apiParams as $v){
            $resParams[$v] = $args[$i];
            $i++;
        }

        return $resParams;
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
        $response = $guzzleClient->request('GET', $url, $args);
        $content = (string)$response->getBody();

        $object = '';

        if('' != $content){
            $object = json_decode($content, true);
        }
        
        return $object;
    }
}