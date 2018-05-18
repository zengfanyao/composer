<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 14:22
 */

require  __DIR__.'/vendor/autoload.php';

//下单
$get_params =array(
    'merId' =>'777290058112538',
    'orderId' => date('YmdHis'),
    'txnTime' => date('YmdHis'),
    'txnAmt' => '1000',
    'certPath' =>'/opt/acp_test_sign.pfx',
    'certPwd' => '000000',
    'frontUrl' =>'https://www.apinktara.cn',
    'backUrl' => 'http://www.apinktara.cn/index.php',
);
$webPay = new \Apink\Payment\Unionpay\WebPay($get_params);
$res= $webPay->consume([]);
echo $res;




