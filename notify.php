<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/18
 * Time: 16:49
 */

require __DIR__ . '/vendor/autoload.php';
//if (empty($_POST) && empty($_GET)) {
//    return false;
//}
$get_params = array(
    'merId' => '777290058112538', //商户号
    'certPath' => '/opt/acp_test_sign.pfx',
    'certDir' => '/opt', //cer文件目录
    'certPwd' => '000000',
);
$data = $_POST;

//$data=<<<EOF
//{"accNo":"6216***********0018","accessType":"0","bizType":"000201","certId":"69026276696","currencyCode":"156","encoding":"utf-8","merId":"777290058112538","orderId":"20180518102730","queryId":"701805181027307541038","respCode":"00","respMsg":"Success!","settleAmt":"1000","settleCurrencyCode":"156","settleDate":"0518","signMethod":"01","traceNo":"754103","traceTime":"0518102730","txnAmt":"1000","txnSubType":"01","txnTime":"20180518102730","txnType":"01","version":"5.0.0","signature":"Sp43wsipQow5g93j9JF0zOVwERa1E7lZBQ65nmImFL8MSzBy1D5hp\/PHlCbsLQMHNYcd+n98KIednk0cBwnTh7XzXdMOVGCLE927RJJ3dX70C\/Pp9k+Ve8GDc9pbPTluoG+R78\/q+Z7zzkKID9kSqsUBb8TazBNzAmma6mevlI1E2jTejI0Sqr8isImVtH4wQfvrzeWFc4mO8D04SWg6yTatkewKP9f9wTXtR5s+Fnx3pQAM2pTxhcdKoGbKpG\/QSQEgmC27w+PAvMvdAL871zGRFbmPZeQ7KfOcp+k4Y3lA\/CmfeKySq+LFWBquwiwGcB5LHne8q7qh7DxAjg1t\/Q=="}
//EOF;
$webPay = new \Apink\Payment\Unionpay\WebPay($get_params);
try{
    $res = $webPay->verify($data);
    if ($res){
        $webPay->returnSuccess();
    }

//    var_dump($res);
}catch (\Exception $exception){
//    var_dump($exception->getMessage());
    file_put_contents("/usr/local/nginx/html/union.txt",json_encode('failure'),FILE_APPEND);
    file_put_contents("/usr/local/nginx/html/union.txt",json_encode($exception->getMessage()),FILE_APPEND);
    print_r('error');
}

//file_put_contents("/usr/local/nginx/html/union.txt",json_encode('success'),FILE_APPEND);
$webPay->returnSuccess();


