<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 14:22
 */

require  __DIR__.'/vendor/autoload.php';



$get_params =array(
    'merId' =>'777290058112538',
    'orderId' => date('YmdHis'),
    'txnTime' => date('YmdHis'),
    'txnAmt' => '1000',
    'certPath' =>'/Users/yao/Downloads/网关支付产品技术开发包1.1.8/PHP Version SDK/upacp_demo_b2c/assets/测试环境证书/acp_test_sign.pfx',
    'certPwd' => '000000',
    'frontUrl' =>'https://www.baidu.com',
    'backUrl' => 'http://www.apinktara.cn/index.php',
);
$webPay = new \Apink\Payment\Unionpay\WebPay($get_params);
$res= $webPay->consume([]);
echo $res;




