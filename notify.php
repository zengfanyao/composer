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
//} else {
//    file_put_contents("/usr/local/nginx/html/union.txt", json_encode($_POST), FILE_APPEND);
//}

//$data = <<<EOF
//{"accessType":"0","bizType":"000202","currencyCode":"156","encoding":"utf-8","merId":"777290058159786","orderId":"20180522141731","queryId":"871805221417310229758","respCode":"00","respMsg":"\u6210\u529f[0000000]","settleAmt":"1000","settleCurrencyCode":"156","settleDate":"0522","signMethod":"01","signPubKeyCert":"-----BEGIN CERTIFICATE-----\r\nMIIEQzCCAyugAwIBAgIFEBJJZVgwDQYJKoZIhvcNAQEFBQAwWDELMAkGA1UEBhMC\r\nQ04xMDAuBgNVBAoTJ0NoaW5hIEZpbmFuY2lhbCBDZXJ0aWZpY2F0aW9uIEF1dGhv\r\ncml0eTEXMBUGA1UEAxMOQ0ZDQSBURVNUIE9DQTEwHhcNMTcxMTAxMDcyNDA4WhcN\r\nMjAxMTAxMDcyNDA4WjB3MQswCQYDVQQGEwJjbjESMBAGA1UEChMJQ0ZDQSBPQ0Ex\r\nMQ4wDAYDVQQLEwVDVVBSQTEUMBIGA1UECxMLRW50ZXJwcmlzZXMxLjAsBgNVBAMU\r\nJTA0MUBaMjAxNy0xMS0xQDAwMDQwMDAwOlNJR05AMDAwMDAwMDEwggEiMA0GCSqG\r\nSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDDIWO6AESrg+34HgbU9mSpgef0sl6avr1d\r\nbD\/IjjZYM63SoQi3CZHZUyoyzBKodRzowJrwXmd+hCmdcIfavdvfwi6x+ptJNp9d\r\nEtpfEAnJk+4quriQFj1dNiv6uP8ARgn07UMhgdYB7D8aA1j77Yk1ROx7+LFeo7rZ\r\nDdde2U1opPxjIqOPqiPno78JMXpFn7LiGPXu75bwY2rYIGEEImnypgiYuW1vo9UO\r\nG47NMWTnsIdy68FquPSw5FKp5foL825GNX3oJSZui8d2UDkMLBasf06Jz0JKz5AV\r\nblaI+s24\/iCfo8r+6WaCs8e6BDkaijJkR\/bvRCQeQpbX3V8WoTLVAgMBAAGjgfQw\r\ngfEwHwYDVR0jBBgwFoAUz3CdYeudfC6498sCQPcJnf4zdIAwSAYDVR0gBEEwPzA9\r\nBghggRyG7yoBATAxMC8GCCsGAQUFBwIBFiNodHRwOi8vd3d3LmNmY2EuY29tLmNu\r\nL3VzL3VzLTE0Lmh0bTA5BgNVHR8EMjAwMC6gLKAqhihodHRwOi8vdWNybC5jZmNh\r\nLmNvbS5jbi9SU0EvY3JsMjQ4NzIuY3JsMAsGA1UdDwQEAwID6DAdBgNVHQ4EFgQU\r\nmQQLyuqYjES7qKO+zOkzEbvdFwgwHQYDVR0lBBYwFAYIKwYBBQUHAwIGCCsGAQUF\r\nBwMEMA0GCSqGSIb3DQEBBQUAA4IBAQAujhBuOcuxA+VzoUH84uoFt5aaBM3vGlpW\r\nKVMz6BUsLbIpp1ho5h+LaMnxMs6jdXXDh\/du8X5SKMaIddiLw7ujZy1LibKy2jYi\r\nYYfs3tbZ0ffCKQtv78vCgC+IxUUurALY4w58fRLLdu8u8p9jyRFHsQEwSq+W5+bP\r\nMTh2w7cDd9h+6KoCN6AMI1Ly7MxRIhCbNBL9bzaxF9B5GK86ARY7ixkuDCEl4XCF\r\nJGxeoye9R46NqZ6AA\/k97mJun\/\/gmUjStmb9PUXA59fR5suAB5o\/5lBySZ8UXkrI\r\npp\/iLT8vIl1hNgLh0Ghs7DBSx99I+S3VuUzjHNxL6fGRhlix7Rb8\r\n-----END CERTIFICATE-----","traceNo":"022975","traceTime":"0522141731","txnAmt":"1000","txnSubType":"01","txnTime":"20180522141731","txnType":"01","version":"5.1.0","signature":"ZVDuaR8TWZr3b2B+6bTyqoZ1qmMIJFi2UxFpZmPuynVjmpqTnT1XdEAia0yW9WqrODZQInEiFlTBb4AX3h0tiEzoeZj7Uo5L5EFM+ZIi5HoZQUdPE9s8FRDC13tC2kMdGaVANRNCvyIoMAiDwZKME6jZACVxCCGpBk0IQy22m5O24Wwld6azR+PJyCwsMzPFTg7Rp1anIWIfpxgydZyGID84V2O0uI5awsQPuv38ZXyTfk1IgLofRpgNgaWpaVVQgzXM5Bw+SH56NHvHzSbkxBFBFMJ\/M74E2mx7a5aGYqJ4WZnHcEq0r1aBcqORqqIqY\/YRNnW6A0OIyZOrsNA7Fg=="}
//EOF;
$params =[
    'accessType'=>'0',
    'bizType' =>'000202',
    'currencyCode' =>'156',
    'encoding' =>'utf-8',
    'merId' =>'777290058159786',
    'orderId' =>'20180522141731',
    'queryId' =>'871805221417310229758',
    'respCode' =>'00',
    'respMsg' =>'成功[0000000]',
    'settleAmt' =>'1000',
    'settleCurrencyCode' =>'156',
    'settleDate0' =>'0522',
    'signMethod' =>'01',
    'signPubKeyCert' =>'-----BEGIN CERTIFICATE-----
    MIIEQzCCAyugAwIBAgIFEBJJZVgwDQYJKoZIhvcNAQEFBQAwWDELMAkGA1UEBhMC
    Q04xMDAuBgNVBAoTJ0NoaW5hIEZpbmFuY2lhbCBDZXJ0aWZpY2F0aW9uIEF1dGhv
    cml0eTEXMBUGA1UEAxMOQ0ZDQSBURVNUIE9DQTEwHhcNMTcxMTAxMDcyNDA4WhcN
    MjAxMTAxMDcyNDA4WjB3MQswCQYDVQQGEwJjbjESMBAGA1UEChMJQ0ZDQSBPQ0Ex
    MQ4wDAYDVQQLEwVDVVBSQTEUMBIGA1UECxMLRW50ZXJwcmlzZXMxLjAsBgNVBAMU
    JTA0MUBaMjAxNy0xMS0xQDAwMDQwMDAwOlNJR05AMDAwMDAwMDEwggEiMA0GCSqG
    SIb3DQEBAQUAA4IBDwAwggEKAoIBAQDDIWO6AESrg+34HgbU9mSpgef0sl6avr1d
    bD\/IjjZYM63SoQi3CZHZUyoyzBKodRzowJrwXmd+hCmdcIfavdvfwi6x+ptJNp9d
    EtpfEAnJk+4quriQFj1dNiv6uP8ARgn07UMhgdYB7D8aA1j77Yk1ROx7+LFeo7rZ
    Ddde2U1opPxjIqOPqiPno78JMXpFn7LiGPXu75bwY2rYIGEEImnypgiYuW1vo9UO
    G47NMWTnsIdy68FquPSw5FKp5foL825GNX3oJSZui8d2UDkMLBasf06Jz0JKz5AV
    blaI+s24\/iCfo8r+6WaCs8e6BDkaijJkR\/bvRCQeQpbX3V8WoTLVAgMBAAGjgfQw
    gfEwHwYDVR0jBBgwFoAUz3CdYeudfC6498sCQPcJnf4zdIAwSAYDVR0gBEEwPzA9
    BghggRyG7yoBATAxMC8GCCsGAQUFBwIBFiNodHRwOi8vd3d3LmNmY2EuY29tLmNu
    L3VzL3VzLTE0Lmh0bTA5BgNVHR8EMjAwMC6gLKAqhihodHRwOi8vdWNybC5jZmNh
    LmNvbS5jbi9SU0EvY3JsMjQ4NzIuY3JsMAsGA1UdDwQEAwID6DAdBgNVHQ4EFgQU
    mQQLyuqYjES7qKO+zOkzEbvdFwgwHQYDVR0lBBYwFAYIKwYBBQUHAwIGCCsGAQUF
    BwMEMA0GCSqGSIb3DQEBBQUAA4IBAQAujhBuOcuxA+VzoUH84uoFt5aaBM3vGlpW
    KVMz6BUsLbIpp1ho5h+LaMnxMs6jdXXDh\/du8X5SKMaIddiLw7ujZy1LibKy2jYi
    YYfs3tbZ0ffCKQtv78vCgC+IxUUurALY4w58fRLLdu8u8p9jyRFHsQEwSq+W5+bP
    MTh2w7cDd9h+6KoCN6AMI1Ly7MxRIhCbNBL9bzaxF9B5GK86ARY7ixkuDCEl4XCF
    JGxeoye9R46NqZ6AA\/k97mJun\/\/gmUjStmb9PUXA59fR5suAB5o\/5lBySZ8UXkrI
    pp\/iLT8vIl1hNgLh0Ghs7DBSx99I+S3VuUzjHNxL6fGRhlix7Rb8
    -----END CERTIFICATE-----',
    'traceNo' =>'022975',
    'traceTime' =>'0522141731',
    'txnAmt' =>'1000',
    'version'=>'5.1.0',
    'signature' =>'ZVDuaR8TWZr3b2B+6bTyqoZ1qmMIJFi2UxFpZmPuynVjmpqTnT1XdEAia0yW9WqrODZQInEiFlTBb4AX3h0tiEzoeZj7Uo5L5EFM+ZIi5HoZQUdPE9s8FRDC13tC2kMdGaVANRNCvyIoMAiDwZKME6jZACVxCCGpBk0IQy22m5O24Wwld6azR+PJyCwsMzPFTg7Rp1anIWIfpxgydZyGID84V2O0uI5awsQPuv38ZXyTfk1IgLofRpgNgaWpaVVQgzXM5Bw+SH56NHvHzSbkxBFBFMJ\/M74E2mx7a5aGYqJ4WZnHcEq0r1aBcqORqqIqY\/YRNnW6A0OIyZOrsNA7Fg==0'
];


//try {
//    $params = json_decode($data);
//    var_dump(json_last_error());
//    die;
//} catch (Exception $e) {
//    print_r($e->getMessage());
//}
//print_r($params);
$params =$_POST;
$state = \Apink\Payment\Unionpay\CompanyPay\CompanyPay::validate($params);
if ($state) {
    echo "Success";
} else {
    echo "Failure";
}
//$get_params = array(
//    'merId' => '777290058112538', //商户号
//    'certPath' => '/opt/acp_test_sign.pfx',
//    'certDir' => '/opt', //cer文件目录
//    'certPwd' => '000000',
//);
//$data = $_POST;
//
////$data=<<<EOF
////{"accNo":"6216***********0018","accessType":"0","bizType":"000201","certId":"69026276696","currencyCode":"156","encoding":"utf-8","merId":"777290058112538","orderId":"20180518102730","queryId":"701805181027307541038","respCode":"00","respMsg":"Success!","settleAmt":"1000","settleCurrencyCode":"156","settleDate":"0518","signMethod":"01","traceNo":"754103","traceTime":"0518102730","txnAmt":"1000","txnSubType":"01","txnTime":"20180518102730","txnType":"01","version":"5.0.0","signature":"Sp43wsipQow5g93j9JF0zOVwERa1E7lZBQ65nmImFL8MSzBy1D5hp\/PHlCbsLQMHNYcd+n98KIednk0cBwnTh7XzXdMOVGCLE927RJJ3dX70C\/Pp9k+Ve8GDc9pbPTluoG+R78\/q+Z7zzkKID9kSqsUBb8TazBNzAmma6mevlI1E2jTejI0Sqr8isImVtH4wQfvrzeWFc4mO8D04SWg6yTatkewKP9f9wTXtR5s+Fnx3pQAM2pTxhcdKoGbKpG\/QSQEgmC27w+PAvMvdAL871zGRFbmPZeQ7KfOcp+k4Y3lA\/CmfeKySq+LFWBquwiwGcB5LHne8q7qh7DxAjg1t\/Q=="}
////EOF;
//$webPay = new \Apink\Payment\Unionpay\WebPay($get_params);
//try{
//    $res = $webPay->verify($data);
//    if ($res){
//        $webPay->returnSuccess();
//    }
//
////    var_dump($res);
//}catch (\Exception $exception){
////    var_dump($exception->getMessage());
//    file_put_contents("/usr/local/nginx/html/union.txt",json_encode('failure'),FILE_APPEND);
//    file_put_contents("/usr/local/nginx/html/union.txt",json_encode($exception->getMessage()),FILE_APPEND);
//    print_r('error');
//}
//
////file_put_contents("/usr/local/nginx/html/union.txt",json_encode('success'),FILE_APPEND);
//$webPay->returnSuccess();


