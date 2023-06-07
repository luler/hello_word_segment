<?php
/**
 * Created by PhpStorm.
 * User: LinZhou <1207032539@qq.com>
 * Date: 2020/1/19
 * Time: 14:41
 */

/**
 * 抛出异常（限制异常code）
 * @param $message
 * @param $code
 * @throws Exception
 * @author LinZhou <1207032539@qq.com>
 */
function throwException($message, $code = 400)
{
    if (!in_array($code, [400, 401, 403, 404, 405, 500, 501, 502, 503])) {
        $code = 400;
    }
    throw new \Exception($message, $code);
}

/**
 * 打印变量
 * @param $var
 * @author 我只想看看蓝天 <1207032539@qq.com>
 */
function dump($var)
{
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
    if (PHP_SAPI == 'cli') {
        $output = PHP_EOL . $output . PHP_EOL;
    } else {
        if (!extension_loaded('xdebug')) {
            $output = htmlspecialchars($output, ENT_SUBSTITUTE);
        }
        $output = '<pre>' . $output . '</pre>';
    }
    echo($output);
    return;
}

/**
 * 打印变量并终止程序向下运行
 * @param $var
 * @author 我只想看看蓝天 <1207032539@qq.com>
 */
function halt($var)
{
    dump($var);
    throw new \Exception();
}

/**
 * 获取请求参数(白名单筛选)
 * @param array $fields
 * @return array|mixed
 * @author LinZhou <1207032539@qq.com>
 */
function _apiParam(array $fields = [])
{
    $request = \EasySwoole\Component\Context\ContextManager::getInstance()->get('request');
    $param = $request->getRequestParam();
    $body_param = json_decode($request->getBody()->getContents(), true) ?: [];
    $param = array_merge($param, $body_param);
    if (!empty($fields)) {
        foreach ($param as $key => $value) {
            if (!in_array($key, $fields)) {
                unset($param[$key]);
            }
        }
    }
    return $param;
}
