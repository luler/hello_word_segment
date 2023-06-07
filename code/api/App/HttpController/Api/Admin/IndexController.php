<?php


namespace App\HttpController\Api\Admin;

use App\HttpController\Common\AdminBaseController;

class IndexController extends AdminBaseController
{
    /**
     * 测试
     * @author LinZhou <1207032539@qq.com>
     */
    public function test()
    {
        $this->successResponse('获取成功');
    }


}
