<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 14:56
 */

namespace Apink\Payment\Unionpay;
use Exception;

class BaseUnionpay
{
    public $config =[];
    public function __construct($config=[]){
//        if (empty($config['mer_id'])){
//            throw new Exception("缺少配置mer_id");
//        }
//        if (empty($config['private_key_path'])) {
//            throw new Exception('缺少配置private_key_path');
//        }
//        if (empty($config['private_key_pwd'])) {
//            throw new Exception('缺少配置private_key_pwd');
//        }
//        if (empty($config['cert_dir'])) {
//            throw new Exception('缺少配置cert_dir');
//        }
//        $this->config = $config;
    }

    /**
     * @param array $data
     * 设置参数
     */
    public function setPassbackParams($data=array()){
        $str_arr = array();
        foreach ($data as $k =>$v){
            $str_arr[] = $k.'--'.$v;
        }
        return implode('---',$str_arr);
    }

    /**
     * @param $str
     * 获取自定义字段
     */
    public function getPassbackParams($str){
        $str_arr = explode('---', $str);
        $data = array();
        foreach ($str_arr as $v) {
            $temp = explode('--', $v);
            $data[$temp[0]] = $temp[1];
        }
        return $data;
    }
}