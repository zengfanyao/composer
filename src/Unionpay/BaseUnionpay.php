<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 14:56
 */

namespace Apink\Payment\Unionpay;

use Apink\Payment\Unionpay\Utils\Urls;
use Exception;

class BaseUnionpay
{
    public $config = [];
    public $debug = false;
    public static $urls;

    public function __construct($config = [])
    {
        if (empty($config['merId'])) {
            throw new Exception("缺少配置merId");
        }
        if (empty($config['certPath'])) {
            throw new Exception('缺少配置certPath');
        }
        if (empty($config['certPwd'])) {
            throw new Exception('缺少配置certPwd');
        }
        $this->config = $config;
        //加载设置地址
        if (!$this->debug) {
            self::$urls = Urls::$development;
        } else {
            self::$urls = Urls::$production;
        }
    }

    /**
     * @param array $data
     * 设置参数
     */
    public function setPassbackParams($data = array())
    {
        $str_arr = array();
        foreach ($data as $k => $v) {
            $str_arr[] = $k . '--' . $v;
        }
        return implode('---', $str_arr);
    }

    /**
     * @param $str
     * 获取自定义字段
     */
    public function getPassbackParams($str)
    {
        $str_arr = explode('---', $str);
        $data = array();
        foreach ($str_arr as $v) {
            $temp = explode('--', $v);
            $data[$temp[0]] = $temp[1];
        }
        return $data;
    }
}