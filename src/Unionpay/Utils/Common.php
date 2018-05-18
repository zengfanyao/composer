<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/18
 * Time: 15:28
 */

namespace Apink\Payment\Unionpay\Utils;
/**
 * Class Common
 * @package Apink\Payment\Unionpay\Utils
 * 公共方法
 */

class Common
{
    static function putKeyValueToDictionary($temp, $isKey, $key, &$result, $needUrlDecode){
        if ($isKey) {
            $key = $temp;
            if (strlen ( $key ) == 0) {
                return false;
            }
            $result [$key] = "";
        } else {
            if (strlen ( $key ) == 0) {
                return false;
            }
            if ($needUrlDecode)
                $result [$key] = urldecode ( $temp );
            else
                $result [$key] = $temp;
        }
    }
    /**
     * key1=value1&key2=value2转array
     * @param $str key1=value1&key2=value2的字符串
     * @param $$needUrlDecode 是否需要解url编码，默认不需要
     */
    static function parseQString($str,$needUrlDecode=false){
        $result = array();
        $len = strlen($str);
        $temp = "";
        $curChar = "";
        $key = "";
        $isKey = true;
        $isOpen = false;
        $openName = "\0";

        for($i=0; $i<$len; $i++){
            $curChar = $str[$i];
            if($isOpen){
                if( $curChar == $openName){
                    $isOpen = false;
                }
                $temp = $temp . $curChar;
            } elseif ($curChar == "{"){
                $isOpen = true;
                $openName = "}";
                $temp = $temp . $curChar;
            } elseif ($curChar == "["){
                $isOpen = true;
                $openName = "]";
                $temp = $temp . $curChar;
            } elseif ($isKey && $curChar == "="){
                $key = $temp;
                $temp = "";
                $isKey = false;
            } elseif ( $curChar == "&" && !$isOpen){
                self::putKeyValueToDictionary($temp, $isKey, $key, $result, $needUrlDecode);
                $temp = "";
                $isKey = true;
            } else {
                $temp = $temp . $curChar;
            }
        }
        self::putKeyValueToDictionary($temp, $isKey, $key, $result, $needUrlDecode);
        return $result;
    }
}