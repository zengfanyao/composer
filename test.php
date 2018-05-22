<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 14:22
 */

require __DIR__ . '/vendor/autoload.php';

//下单
//$get_params =array(
//    'merId' =>'777290058112538', //商户号
//    'orderId' => date('YmdHis'), //订单号
//    'txnTime' => date('YmdHis'),
//    'txnAmt' => '1000', //金额
//    'certPath' =>'/opt/acp_test_sign.pfx',
//    'certPwd' => '000000',
//    'frontUrl' =>'https://www.apinktara.cn',
//    'backUrl' => 'http://www.apinktara.cn/composer/notify.php',
//);
//$webPay = new \Apink\Payment\Unionpay\WebPay($get_params);
//$res= $webPay->consume([]);
//echo $res;

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


#######################################################################################################
////银行侧开通
//date_default_timezone_set('PRC');
//$accNo = '6216261000000000018';
//$customerInfo = array(
////    'phoneNo' => '13552535506', //手机号
//    'certifTp' => '01', //证件类型，01-身份证
//    'certifId' => '341126197709218366', //证件号，15位身份证不校验尾号，18位会校验尾号，请务必在前端写好校验代码
//    'customerNm' => '全渠道', //姓名
////   		'cvn2' => '248', //cvn2
////   		'expired' => '1912', //有效期，YYMM格式，持卡人卡面印的是MMYY的，请注意代码设置倒一下
//);
////敏感信息加密证书路径(商户号开通了商户对敏感信息加密的权限，需要对 卡号accNo，pin和phoneNo，cvn2，expired加密（如果这些上送的话），对敏感信息加密使用)
//$cert_path = '/Users/yao/Desktop/银联测试/测试环境证书/acp_test_enc.cer';
////$cert_path = '/Users/yao/Downloads/无跳转支付产品技术开发包V1.1.8/PHP Version SDK/token版/upacp_demo_wtz_token/assets/测试环境证书/acp_test_enc.cer';
//$sign_cert_pwd = '000000';
//$sign_cert_path = '/Users/yao/Desktop/银联测试/测试环境证书/acp_test_sign.pfx';
////$sign_cert_path='/Users/yao/Downloads/无跳转支付产品技术开发包V1.1.8/PHP Version SDK/token版/upacp_demo_wtz_token/assets/测试环境证书/acp_test_sign.pfx';
//$params = array(
//    'version' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->version,
//    'encoding' => 'utf-8',                  //编码方式
//    'signMethod' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->signMethod,
//    'txnType' => '79',                      //交易类型
//    'txnSubType' => '00',                  //交易子类
//    'bizType' => '000902',                  //业务类型
//    'accessType' => '0',                  //接入类型
//    'channelType' => '07',                  //渠道类型，07-PC，08-手机
//    'encryptCertId' => \Apink\Payment\Unionpay\TokenPay\TokenPay::getEncryptCertId($cert_path),
//    'frontUrl' => 'http://www.apinktara.cn',
//    'backUrl' => 'http://www.apinktara.cn/composer/notify.php',
//    'merId' => '777290058159786',
//    'orderId' => date('YmdHis'),
//    'txnTime' => date('YmdHis'),
//    ////测试环境固定trId=62000000001&tokenType=01，生产环境由业务分配。测试环境因为所有商户都使用同一个trId，所以同一个卡获取的token号都相同，任一人发起更新token或者解除token请求都会导致原token号失效，所以之前成功、突然出现3900002报错时请先尝试重新开通一下。
//    'tokenPayData' => '{trId=62000000001&tokenType=01}',
//    'accNo' => \Apink\Payment\Unionpay\TokenPay\TokenPay::encryptData($accNo, $cert_path),
//    'customerInfo' => \Apink\Payment\Unionpay\TokenPay\TokenPay::getCustomerInfoWithEncrypt($customerInfo, $cert_path),
//    'payTimeout' => date('YmdHis', strtotime('+15 minutes'))
//);
//$html_form = \Apink\Payment\Unionpay\TokenBasePay::bankOpenToken($params, $sign_cert_path, $sign_cert_pwd);
//echo $html_form;

//##############################################################银行侧开通状态查询##########################
//$cert_path = '/Users/yao/Desktop/银联测试/测试环境证书/acp_test_enc.cer';
//$sign_cert_pwd = '000000';
//$sign_cert_path = '/Users/yao/Desktop/银联测试/测试环境证书/acp_test_sign.pfx';
//$accNo = '6216261000000000018';
//$params = array(
//
//    //以下信息非特殊情况不需要改动
//    'version' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->version,                   //版本号
//    'encoding' => 'utf-8',                   //编码方式
//    'signMethod' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->signMethod,                   //签名方法
//    'txnType' => '78',                       //交易类型
//    'txnSubType' => '02',                   //交易子类
//    'bizType' => '000902',                   //业务类型
//    'accessType' => '0',                   //接入类型
//    'channelType' => '07',                   //渠道类型
//    'encryptCertId' => \Apink\Payment\Unionpay\TokenPay\TokenPay::getEncryptCertId($cert_path),
//    //TODO 以下信息需要填写
//    'merId' => '777290058159786',//商户代码
//    'orderId' => '20180521194931',//商户订单号，填写被查询开通交易的orderId
//    'txnTime' => '20180521194931',//订单发送时间，填写被查询开通交易的txnTime
//);
//
//$result_arr = \Apink\Payment\Unionpay\TokenBasePay::bankTokenStatus($params, $sign_cert_path, $sign_cert_pwd);
//echo "<pre>";
//print_r($result_arr);
//$statues =\Apink\Payment\Unionpay\Utils\AcpService::validate($params,'/Users/yao/Desktop/银联测试/测试环境证书');
//if ($result_arr) {
//    print_r("应答成功");
//}else {
//    print_r("应答失败");
//}
###################################企业银联支付######################################
date_default_timezone_set('PRC');
$cert_path = '/Users/yao/Desktop/银联测试/测试环境证书/acp_test_enc.cer';
$sign_cert_pwd = '000000';
$sign_cert_path = '/Users/yao/Desktop/银联测试/测试环境证书/acp_test_sign.pfx';
$params = array(

    //以下信息非特殊情况不需要改动
    'version' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->version,                 //版本号
    'encoding' => 'utf-8',                  //编码方式
    'txnType' => '01',                      //交易类型
    'txnSubType' => '01',                  //交易子类
    'bizType' => '000202',                  //业务类型
    'frontUrl' => 'http://www.apinktara.cn',  //前台通知地址
    'backUrl' => 'http://www.apinktara.cn/composer/notify.php',      //后台通知地址
    'signMethod' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->signMethod,                  //签名方法
    'channelType' => '07',                  //渠道类型，07-PC，08-手机
    'accessType' => '0',                  //接入类型
    'currencyCode' => '156',              //交易币种，境内商户固定156

    //TODO 以下信息需要填写
    'merId' => '777290058159786',        //商户代码，请改自己的测试商户号，此处默认取demo演示页面传递的参数
    'orderId' => date("YmdHis"),    //商户订单号，8-32位数字字母，不能含“-”或“_”，此处默认取demo演示页面传递的参数，可以自行定制规则
    'txnTime' => date("YmdHis"),    //订单发送时间，格式为YYYYMMDDhhmmss，取北京时间，此处默认取demo演示页面传递的参数
    'txnAmt' => 1000,    //交易金额，单位分，此处默认取demo演示页面传递的参数

    // 订单超时时间。
    // 超过此时间后，除网银交易外，其他交易银联系统会拒绝受理，提示超时。 跳转银行网银交易如果超时后交易成功，会自动退款，大约5个工作日金额返还到持卡人账户。
    // 此时间建议取支付时的北京时间加15分钟。
    // 超过超时时间调查询接口应答origRespCode不是A6或者00的就可以判断为失败。
    'payTimeout' => date('YmdHis', strtotime('+15 minutes')),

    // 请求方保留域，
    // 透传字段，查询、通知、对账文件中均会原样出现，如有需要请启用并修改自己希望透传的数据。
    // 出现部分特殊字符时可能影响解析，请按下面建议的方式填写：
    // 1. 如果能确定内容不会出现&={}[]"'等符号时，可以直接填写数据，建议的方法如下。
    //    'reqReserved' =>'透传信息1|透传信息2|透传信息3',
    // 2. 内容可能出现&={}[]"'符号时：
    // 1) 如果需要对账文件里能显示，可将字符替换成全角＆＝｛｝【】“‘字符（自己写代码，此处不演示）；
    // 2) 如果对账文件没有显示要求，可做一下base64（如下）。
    //    注意控制数据长度，实际传输的数据长度不能超过1024位。
    //    查询、通知等接口解析时使用base64_decode解base64后再对数据做后续解析。
    //    'reqReserved' => base64_encode('任意格式的信息都可以'),

    //TODO 其他特殊用法：
    //【直接跳转发卡行网银】
    //（因测试环境所有商户号都默认不允许开通网银支付权限，所以要实现此功能需要使用正式申请的商户号去生产环境测试）：
    // 1）联系银联业务运营部门开通商户号的网银前置权限
    // 2）上送issInsCode字段，该字段的值参考《平台接入接口规范-第5部分-附录》（全渠道平台银行名称-简码对照表）
    //'issInsCode' => 'ABC',  //发卡机构代码
);
//echo "<pre>";
//print_r($params);
//die;
$html_form = \Apink\Payment\Unionpay\CompanyPay\CompanyPay::frontConsume($params, $sign_cert_path, $sign_cert_pwd);
echo $html_form;

############################交易状态查询######################################
//$cert_path = '/Users/yao/Desktop/银联测试/测试环境证书/acp_test_enc.cer';
//$sign_cert_pwd = '000000';
//$sign_cert_path = '/Users/yao/Desktop/银联测试/测试环境证书/acp_test_sign.pfx';
//$data=<<<EOF
//{"accessType":"0","bizType":"000202","currencyCode":"156","encoding":"utf-8","merId":"777290058159786","orderId":"20180521212847","queryId":"301805212128470220258","respCode":"00","respMsg":"\u6210\u529f[0000000]","settleAmt":"1000","settleCurrencyCode":"156","settleDate":"0521","signMethod":"01","signPubKeyCert":"-----BEGIN CERTIFICATE-----\r\nMIIEQzCCAyugAwIBAgIFEBJJZVgwDQYJKoZIhvcNAQEFBQAwWDELMAkGA1UEBhMC\r\nQ04xMDAuBgNVBAoTJ0NoaW5hIEZpbmFuY2lhbCBDZXJ0aWZpY2F0aW9uIEF1dGhv\r\ncml0eTEXMBUGA1UEAxMOQ0ZDQSBURVNUIE9DQTEwHhcNMTcxMTAxMDcyNDA4WhcN\r\nMjAxMTAxMDcyNDA4WjB3MQswCQYDVQQGEwJjbjESMBAGA1UEChMJQ0ZDQSBPQ0Ex\r\nMQ4wDAYDVQQLEwVDVVBSQTEUMBIGA1UECxMLRW50ZXJwcmlzZXMxLjAsBgNVBAMU\r\nJTA0MUBaMjAxNy0xMS0xQDAwMDQwMDAwOlNJR05AMDAwMDAwMDEwggEiMA0GCSqG\r\nSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDDIWO6AESrg+34HgbU9mSpgef0sl6avr1d\r\nbD\/IjjZYM63SoQi3CZHZUyoyzBKodRzowJrwXmd+hCmdcIfavdvfwi6x+ptJNp9d\r\nEtpfEAnJk+4quriQFj1dNiv6uP8ARgn07UMhgdYB7D8aA1j77Yk1ROx7+LFeo7rZ\r\nDdde2U1opPxjIqOPqiPno78JMXpFn7LiGPXu75bwY2rYIGEEImnypgiYuW1vo9UO\r\nG47NMWTnsIdy68FquPSw5FKp5foL825GNX3oJSZui8d2UDkMLBasf06Jz0JKz5AV\r\nblaI+s24\/iCfo8r+6WaCs8e6BDkaijJkR\/bvRCQeQpbX3V8WoTLVAgMBAAGjgfQw\r\ngfEwHwYDVR0jBBgwFoAUz3CdYeudfC6498sCQPcJnf4zdIAwSAYDVR0gBEEwPzA9\r\nBghggRyG7yoBATAxMC8GCCsGAQUFBwIBFiNodHRwOi8vd3d3LmNmY2EuY29tLmNu\r\nL3VzL3VzLTE0Lmh0bTA5BgNVHR8EMjAwMC6gLKAqhihodHRwOi8vdWNybC5jZmNh\r\nLmNvbS5jbi9SU0EvY3JsMjQ4NzIuY3JsMAsGA1UdDwQEAwID6DAdBgNVHQ4EFgQU\r\nmQQLyuqYjES7qKO+zOkzEbvdFwgwHQYDVR0lBBYwFAYIKwYBBQUHAwIGCCsGAQUF\r\nBwMEMA0GCSqGSIb3DQEBBQUAA4IBAQAujhBuOcuxA+VzoUH84uoFt5aaBM3vGlpW\r\nKVMz6BUsLbIpp1ho5h+LaMnxMs6jdXXDh\/du8X5SKMaIddiLw7ujZy1LibKy2jYi\r\nYYfs3tbZ0ffCKQtv78vCgC+IxUUurALY4w58fRLLdu8u8p9jyRFHsQEwSq+W5+bP\r\nMTh2w7cDd9h+6KoCN6AMI1Ly7MxRIhCbNBL9bzaxF9B5GK86ARY7ixkuDCEl4XCF\r\nJGxeoye9R46NqZ6AA\/k97mJun\/\/gmUjStmb9PUXA59fR5suAB5o\/5lBySZ8UXkrI\r\npp\/iLT8vIl1hNgLh0Ghs7DBSx99I+S3VuUzjHNxL6fGRhlix7Rb8\r\n-----END CERTIFICATE-----","traceNo":"022025","traceTime":"0521212847","txnAmt":"1000","txnSubType":"01","txnTime":"20180521212847","txnType":"01","version":"5.1.0","signature":"k4808qplQxqaZlCndhPgiMLOFtyibSJoCzMzdd4Ip4s1aMgm2jA3I1puFPjCqr6TEY4dyqfoxqy+Spt8nieCQRGaXcN0iX1ot8eY43npOLHufoFX+3VI8386i3Jaq53dHabAr3qP4o4zEC7EliT4lUDNfITEAiXR6my1LleHHiDbBEAzs5nI9FX0k29dS8m2\/8J1IbcdY\/O+tRDO3aXPUX+99smvZewFvkLnQqtSYA+ydquB49gERlmMeMHWdMqvb+9+auCu8U+ziTvWT7d0wmc4mV2yXAEBcJaenKAc9Npfp0AbWfH8LLyLnh3lz\/1Ndoj1OrDbfqdRQABta+jHWQ=="}
//EOF;
//$data =json_decode($data);

//$data= json_decode($data,true);
//print_r($data);die;
//unset($params);
//$params = array(
//    //以下信息非特殊情况不需要改动
//    'version' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->version,		  //版本号
//    'encoding' => 'utf-8',		  //编码方式
//    'signMethod' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->signMethod,		  //签名方法
//    'txnType' => '00',		      //交易类型
//    'txnSubType' => '00',		  //交易子类
//    'bizType' => '000000',		  //业务类型
//    'accessType' => '0',		  //接入类型
//    'channelType' => '07',		  //渠道类型
//
//    //TODO 以下信息需要填写
//    'orderId' => '20180521212847',	//请修改被查询的交易的订单号，8-32位数字字母，不能含“-”或“_”，此处默认取demo演示页面传递的参数
//    'merId' => '777290058159786',	    //商户代码，请改自己的测试商户号，此处默认取demo演示页面传递的参数
//    'txnTime' => '20180521212847',	//请修改被查询的交易的订单发送时间，格式为YYYYMMDDhhmmss，此处默认取demo演示页面传递的参数
//);
/**
 * 下单状态查询
 */
//$result = \Apink\Payment\Unionpay\CompanyPay\CompanyPay::queryConsume($params,$sign_cert_path,$sign_cert_pwd);
//echo "<pre>";
//print_r($result);

###############################退货查询
//unset($params);
//$params = array(
//
//    //以下信息非特殊情况不需要改动
//    'version' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->version,		      //版本号
//    'encoding' => 'utf-8',		      //编码方式
//    'signMethod' =>\Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->signMethod,		      //签名方法
//    'txnType' => '04',		          //交易类型
//    'txnSubType' => '00',		      //交易子类
//    'bizType' => '000201',		      //业务类型
//    'accessType' => '0',		      //接入类型
//    'channelType' => '07',		      //渠道类型
//    'backUrl' => 'http://www.apinktara.cn/composer/notify.php', //后台通知地址

    //TODO 以下信息需要填写
//    'orderId' => 'T201805212128471',	    //商户订单号，8-32位数字字母，不能含“-”或“_”，可以自行定制规则，重新产生，不同于原消费，此处默认取demo演示页面传递的参数
//    'merId' =>'777290058159786',	        //商户代码，请改成自己的测试商户号，此处默认取demo演示页面传递的参数
//    'origQryId' => '301805212128470220258', //原消费的queryId，可以从查询接口或者通知接口中获取，此处默认取demo演示页面传递的参数
//    'txnTime' =>'20180521212847',	    //订单发送时间，格式为YYYYMMDDhhmmss，重新产生，不同于原消费，此处默认取demo演示页面传递的参数
//    'txnAmt' => '1000',       //交易金额，退货总金额需要小于等于原消费

    // 请求方保留域，
    // 透传字段，查询、通知、对账文件中均会原样出现，如有需要请启用并修改自己希望透传的数据。
    // 出现部分特殊字符时可能影响解析，请按下面建议的方式填写：
    // 1. 如果能确定内容不会出现&={}[]"'等符号时，可以直接填写数据，建议的方法如下。
    //    'reqReserved' =>'透传信息1|透传信息2|透传信息3',
    // 2. 内容可能出现&={}[]"'符号时：
    // 1) 如果需要对账文件里能显示，可将字符替换成全角＆＝｛｝【】“‘字符（自己写代码，此处不演示）；
    // 2) 如果对账文件没有显示要求，可做一下base64（如下）。
    //    注意控制数据长度，实际传输的数据长度不能超过1024位。
    //    查询、通知等接口解析时使用base64_decode解base64后再对数据做后续解析。
    //    'reqReserved' => base64_encode('任意格式的信息都可以'),
//);
//$result=\Apink\Payment\Unionpay\CompanyPay\CompanyPay::reFund($params,$sign_cert_path,$sign_cert_pwd);
//echo "<pre>";
//print_r($result);