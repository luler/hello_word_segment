<?php
/**
 * Created by PhpStorm.
 * User: LinZhou <1207032539@qq.com>
 * Date: 2020/1/19
 * Time: 10:45
 */

namespace App\HttpController;


use EasySwoole\Http\AbstractInterface\AbstractRouter;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use FastRoute\RouteCollector;

class Router extends AbstractRouter
{
    function initialize(RouteCollector $routeCollector)
    {
        $this->setGlobalMode(true);
        $this->setMethodNotAllowCallBack(function (Request $request, Response $response) {
            $response->redirect('/noRouter');
            return false;
        });
        $this->setRouterNotFoundCallBack(function (Request $request, Response $response) {
            $response->redirect('/noRouter');
            return false;
        });
        $routeCollector->get('/noRouter', function (Request $request, Response $response) {
            $response->withStatus(404);
            $response->withHeader('content-type', 'application/json;charset=utf-8');
            $response->write('{"message":"路由不存在","code":404,"info":[]}');
            return false;
        });

        // +----------------------------------------------------------------------
        // | 开发接口
        // +----------------------------------------------------------------------
        $routeCollector->addGroup('/api', function (RouteCollector $routeCollector) {
            // +----------------------------------------------------------------------
            // | 公共接口
            // +----------------------------------------------------------------------
            $routeCollector->get('/test', 'api/home/IndexController/test');
            $routeCollector->post('/jiebaCutForSearch', 'api/home/IndexController/jiebaCutForSearch');
            $routeCollector->post('/jiebaCut', 'api/home/IndexController/jiebaCut');
            // +----------------------------------------------------------------------
            // | 前台接口
            // +----------------------------------------------------------------------
            $routeCollector->addGroup('/home', function (RouteCollector $routeCollector) {
                $routeCollector->get('/test', 'api/home/IndexController/test');
            });
            // +----------------------------------------------------------------------
            // | 后台接口
            // +----------------------------------------------------------------------
            $routeCollector->addGroup('/admin', function (RouteCollector $routeCollector) {
                $routeCollector->get('/test', 'api/admin/IndexController/test');
            });
        });
    }
}
