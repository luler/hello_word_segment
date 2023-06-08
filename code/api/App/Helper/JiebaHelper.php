<?php
/**
 * Created by PhpStorm.
 * User: LinZhou <1207032539@qq.com>
 * Date: 2020/1/19
 * Time: 13:52
 */

namespace App\Helper;

use EasySwoole\Component\Singleton;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Posseg;

class JiebaHelper
{
    use Singleton;

    public function __construct()
    {
        Jieba::init();
        Finalseg::init();
        Posseg::init();
    }

    /**
     * jieba分词-搜索引擎模式
     * @param $sentence
     * @param $options
     * @return array
     * @author 我只想看看蓝天 <1207032539@qq.com>
     */
    public function jiebaCutForSearch($sentence, $options = ["HMM" => true])
    {
        return Jieba::cutForSearch($sentence, $options);
    }

    /**
     * jieba分词-精准模式或者全模式
     * @param $sentence
     * @param $cut_all
     * @param $options
     * @return array
     * @author 我只想看看蓝天 <1207032539@qq.com>
     */
    public function jiebaCut($sentence, $cut_all = false, $options = ["HMM" => true])
    {
        return Jieba::cut($sentence, $cut_all, $options);
    }

    /**
     * 詞性分詞
     * @param $sentence
     * @param $options
     * @return array
     * @author 我只想看看蓝天 <1207032539@qq.com>
     * @link 词性说明：https://gist.github.com/luw2007/6016931
     */
    public function jiebaPossegCut($sentence, $options = ["HMM" => true])
    {
        return Posseg::cut($sentence, $options);
    }
}
