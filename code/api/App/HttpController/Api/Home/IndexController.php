<?php


namespace App\HttpController\Api\Home;

use App\Helper\JiebaHelper;
use App\Helper\ValidateHelper;
use App\HttpController\Common\HomeBaseController;

class IndexController extends HomeBaseController
{
    public function test()
    {
        $this->successResponse('获取成功');
    }

    /**
     * jieba分词-搜索引擎模式
     * @return null
     * @author 我只想看看蓝天 <1207032539@qq.com>
     */
    public function jiebaCutForSearch()
    {
        $field = ['sentence', 'options'];
        $param = _apiParam($field);
        ValidateHelper::checkData($param, [
            'sentence|内容' => 'required',
//            'options|参数选项' => 'required',
        ]);
        if (isset($param['options']) && !is_array($param['options'])) {
            throwException('参数选项必须为数组');
        }

        $res = JiebaHelper::getInstance()->jiebaCutForSearch($param['sentence'], $param['options'] ?? ["HMM" => true]);

        return $this->successResponse('处理成功', $res);
    }

    /**
     * jieba分词-精准模式或者全模式
     * @return null
     * @author 我只想看看蓝天 <1207032539@qq.com>
     */
    public function jiebaCut()
    {
        $field = ['sentence', 'cut_all', 'options'];
        $param = _apiParam($field);
        ValidateHelper::checkData($param, [
            'sentence|内容' => 'required',
//            'options|参数选项' => 'required',
        ]);
        if (isset($param['options']) && !is_array($param['options'])) {
            throwException('参数选项必须为数组');
        }
        if (isset($param['cut_all']) && !is_bool($param['cut_all'])) {
            throwException('是否全模式只能设置bool类型');
        }

        $res = JiebaHelper::getInstance()->jiebaCut($param['sentence'],
            $param['cut_all'] ?? false,
            $param['options'] ?? ["HMM" => true]);

        return $this->successResponse('处理成功', $res);
    }

    /**
     * 詞性分詞
     * @author 我只想看看蓝天 <1207032539@qq.com>
     * @link 词性说明：https://gist.github.com/luw2007/6016931
     */
    public function jiebaPossegCut()
    {
        $field = ['sentence', 'options'];
        $param = _apiParam($field);
        ValidateHelper::checkData($param, [
            'sentence|内容' => 'required',
//            'options|参数选项' => 'required',
        ]);
        if (isset($param['options']) && !is_array($param['options'])) {
            throwException('参数选项必须为数组');
        }

        $res = JiebaHelper::getInstance()->jiebaPossegCut($param['sentence'], $param['options'] ?? ["HMM" => true]);

        return $this->successResponse('处理成功', $res);
    }
}
