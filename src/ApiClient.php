<?php
namespace Sunanzhi\Api;

use GuzzleHttp\Exception\ServerException;


/**
 * 请求api入口
 */
class ApiClient
{
    /**
     * 命名空间
     *
     * @var string
     */
    protected static $namespace;

    /**
     * 模块
     *
     * @var string
     */
    protected static $module;

    /**
     * 控制器
     *
     * @var string
     */
    protected static $moduleClass;

    /**
     * 请求接口
     *
     * @param string $url 请求接口路径
     * @param string $method 请求接口方法
     * @param mixed ...$args 参数
     * @return mixed
     *
     * @author sunanzhi <sunanzhi@hotmail.com>
     */
    public static function request(string $url, string $method, ...$args)
    {
        // 获取api参数
        $apiParams = self::getParams($url, $method);
        // 封装请求参数
        $requestParams = self::packageArgs($apiParams, $args);
        // 获取请求url
        $apiUrl = config('api.PROVIDERURL.' . self::$module) . '/' . self::$module . '/' . self::$moduleClass . '/' . $method;

        return self::guzzleRequest($apiUrl, $requestParams);
    }

    /**
     * 获取接口参数
     *
     * @param string $url 请求接口路径
     * @param string $method 请求接口方法
     * @return array
     * 
     * @author sunanzhi <sunanzhi@hotmail.com>
     */
    private static function getParams(string $url, string $method): array
    {
        // 当前命名空间
        self::$namespace = (new \ReflectionClass(__CLASS__))->getNamespaceName();
        // 获取模块
        $urlExplode = explode('/', $url);
        self::$module = $urlExplode[0];
        self::$moduleClass = $urlExplode[1];

        // 获取接口参数
        $apiParams = array_column((new \ReflectionMethod(self::$namespace . '\\' . self::$module . '\\' . self::$moduleClass, $method))->getParameters(), 'name');

        return $apiParams;
    }

    /**
     * 封装参数
     *
     * @param array $apiParams 接口参数
     * @param array $args 请求的参数
     * @return mixed
     *
     * @author sunanzhi <sunanzhi@hotmail.com>
     */
    private static function packageArgs(array $apiParams, array $args): array
    {
        $resParams = [];
        $i = 0;
        foreach ($apiParams as $v) {
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
     */
    private static function guzzleRequest(string $url, array $args)
    {
        $guzzleClient = new \GuzzleHttp\Client();
        $body = json_encode($args);
        try { 
            $response = $guzzleClient->request('POST', $url, ['body' => $body]);
        } catch (ServerException $e) {
            exception($e->getMessage());
        }
        $content = (string) $response->getBody();
        $object = '';
        
        if ('' != $content) {
            $object = json_decode($content, true);
        }

        return $object;
    }
}
