<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/18
 * Time: 15:36
 */

namespace Apink\Payment\Unionpay\Utils;


class Urls
{
    /**
     * @var array
     * 测试环境地址
     */
    public static $development = [
        // 前台请求地址
        'SDK_FRONT_TRANS_URL' => 'https://101.231.204.80:5000/gateway/api/frontTransReq.do',
        // 后台请求地址
        'SDK_BACK_TRANS_URL' => 'https://101.231.204.80:5000/gateway/api/backTransReq.do',
        //单笔查询请求地址
        'SDK_SINGLE_QUERY_URL' => 'https://101.231.204.80:5000/gateway/api/queryTrans.do',
        //文件传输请求地址
        'SDK_FILE_QUERY_URL' => 'https://101.231.204.80:9080/',
        //有卡交易地址
        'SDK_Card_Request_Url' => 'https://101.231.204.80:5000/gateway/api/cardTransReq.do',
        //App交易地址
        'SDK_App_Request_Url' => 'https://101.231.204.80:5000/gateway/api/appTransReq.do',
    ];
    /**
     * @var array
     * 正式环境地址
     */
    public static $production = [
        // 前台请求地址
        'SDK_FRONT_TRANS_URL' => 'https://gateway.95516.com/gateway/api/frontTransReq.do',
        // 后台请求地址
        'SDK_BACK_TRANS_URL' => 'https://gateway.95516.com/gateway/api/backTransReq.do',
        // 批量交易
        'SDK_BATCH_TRANS_URL' => 'https://gateway.95516.com/gateway/api/batchTrans.do',
        //单笔查询请求地址
        'SDK_SINGLE_QUERY_URL' => 'https://gateway.95516.com/gateway/api/queryTrans.do',
        //有卡交易地址
        'SDK_Card_Request_Url' => 'https://gateway.95516.com/gateway/api/cardTransReq.do',
        //App交易地址
        'SDK_App_Request_Url' => 'https://gateway.95516.com/gateway/api/appTransReq.do',
    ];
}