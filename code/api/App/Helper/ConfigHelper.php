<?php
/**
 * Created by PhpStorm.
 * User: LinZhou <1207032539@qq.com>
 * Date: 2020/1/19
 * Time: 13:52
 */

namespace App\Helper;

use EasySwoole\EasySwoole\Config;

class ConfigHelper
{
    private static $data = [];

    public static function initCustomConfig()
    {
        $config_files = glob('Config/*.php');
        foreach ($config_files as $config_file) {
            \EasySwoole\EasySwoole\Config::getInstance()->loadFile($config_file);
        }
    }

    /**
     * 获取env数据
     * @param $name
     * @param null $default_value
     * @return mixed|null
     * Author: LinZhou <1207032539@qq.com>
     */
    public static function getEnv($name, $default_value = null)
    {
        if (empty(self::$data)) {
            if (file_exists('.env')) {
                self::$data = parse_ini_file('.env', true);
            }
        }

        $config = self::$data;
        $keys = explode('.', $name);
        $value = $default_value;
        foreach ($keys as $key) {
            if (isset($config[$key])) {
                $config = $config[$key];
                $value = $config;
            } else {
                $value = $default_value;
            }
        }
        return $value;
    }

    /**
     * 获取配置
     * @param $name
     * @return mixed|null
     * Author: LinZhou <1207032539@qq.com>
     */
    public static function get($name = '')
    {
        return Config::getInstance()->getConf($name);
    }

}
