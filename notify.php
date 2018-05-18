<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/18
 * Time: 16:49
 */

require __DIR__ . '/vendor/autoload.php';
if (empty($_POST) || empty($_GET)) {
    return false;
}
$get_params = array(
    'merId' => '777290058112538', //商户号
    'certPath' => '/opt/acp_test_sign.pfx',
    'certPwd' => '000000',
);
$data = $_POST;
$webPay = new \Apink\Payment\Unionpay\WebPay($get_params);
try{
    $res = $webPay->verify($data);
}catch (\Exception $exception){
    file_put_contents("/usr/local/nginx/html/union.txt",json_encode('failure'),FILE_APPEND);
    file_put_contents("/usr/local/nginx/html/union.txt",json_encode($exception->getMessage()),FILE_APPEND);
}

file_put_contents("/usr/local/nginx/html/union.txt",json_encode('success'),FILE_APPEND);


