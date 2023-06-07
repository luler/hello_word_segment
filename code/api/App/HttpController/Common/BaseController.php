<?php


namespace App\HttpController\Common;

use EasySwoole\Component\Context\ContextManager;
use EasySwoole\EasySwoole\ServerManager;

class BaseController extends ApiController
{
    protected function onRequest(?string $action): ?bool
    {
        //给每个请求注入全局变量
        ContextManager::getInstance()->set('request', $this->request());
        return true;
    }

    /**
     * 获取用户的真实IP
     * @param string $headerName 代理服务器传递的标头名称
     * @return string
     */
    protected function clientRealIP($headerName = 'x-real-ip')
    {
        $server = ServerManager::getInstance()->getSwooleServer();
        $client = $server->getClientInfo($this->request()->getSwooleRequest()->fd);
        $clientAddress = $client['remote_ip'];
        $xri = $this->request()->getHeader($headerName);
        $xff = $this->request()->getHeader('x-forwarded-for');
        if ($clientAddress === '127.0.0.1') {
            if (!empty($xri)) {  // 如果有xri 则判定为前端有NGINX等代理
                $clientAddress = $xri[0];
            } elseif (!empty($xff)) {  // 如果不存在xri 则继续判断xff
                $list = explode(',', $xff[0]);
                if (isset($list[0])) $clientAddress = $list[0];
            }
        }
        return $clientAddress;
    }

    /**
     * 捕获异常
     * @param \Throwable $throwable
     * @author LinZhou <1207032539@qq.com>
     */
    protected function onException(\Throwable $throwable): void
    {
        if (in_array($throwable->getCode(), [400, 401, 403, 404, 405, 500, 501, 502, 503])) {
            $this->commonResponse($throwable->getCode(), $throwable->getMessage());
        } else {
            //找不到异常原因，就统一报500
            $this->commonResponse(500, $throwable->getMessage());
        }
    }

    /**
     * dump出数据
     * @param $object
     * @author LinZhou <1207032539@qq.com>
     */
    protected function dump($object)
    {
        ob_start();
        var_dump($object);
        $output = ob_get_clean();
        $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
        if (!extension_loaded('xdebug')) {
            $output = htmlspecialchars($output, ENT_SUBSTITUTE);
        }
        $output = '<pre>' . $output . '</pre>';
        $this->response()->write($output);
    }

    /**
     * dump出数据后，立即结束返回
     * @param $object
     * @author LinZhou <1207032539@qq.com>
     */
    protected function halt($object)
    {
        ob_start();
        var_dump($object);
        $output = ob_get_clean();
        $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
        if (!extension_loaded('xdebug')) {
            $output = htmlspecialchars($output, ENT_SUBSTITUTE);
        }
        $output = '<pre>' . $output . '</pre>';
        $this->response()->write($output);
        $this->response()->end();
        throw new \Exception(); //停止往下执行
    }
}
