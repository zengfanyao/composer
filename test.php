<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 14:22
 */

require __DIR__ . '/vendor/autoload.php';

//下单
$get_params =array(
    'merId' =>'777290058112538', //商户号
    'orderId' => date('YmdHis'), //订单号
    'txnTime' => date('YmdHis'),
    'txnAmt' => '1000', //金额
    'certPath' =>'/opt/acp_test_sign.pfx',
    'certPwd' => '000000',
    'frontUrl' =>'https://www.apinktara.cn',
    'backUrl' => 'http://www.apinktara.cn/composer/notify.php',
);
$webPay = new \Apink\Payment\Unionpay\WebPay($get_params);
$res= $webPay->consume([]);
echo $res;

//查询交易
//$get_params = [
//    'orderId' => '20180518080525',
//    'merId' => '777290058112538',
//    'txnTime' => date('YmdHis'),
//    'certPath' => '/Users/yao/Downloads/网关支付产品技术开发包1.1.8/PHP Version SDK/upacp_demo_b2c/assets/测试环境证书/acp_test_sign.pfx',
//    'certPwd' => '000000',
//];
//$webPay = new \Apink\Payment\Unionpay\WebPay($get_params);
//$res = $webPay->queryHandle();
//print_r($res);



