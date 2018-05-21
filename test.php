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
//银行侧开通

date_default_timezone_set('PRC');
$accNo = '6216261000000000018';
$customerInfo = array(
//    'phoneNo' => '13552535506', //手机号
    'certifTp' => '01', //证件类型，01-身份证
    'certifId' => '341126197709218366', //证件号，15位身份证不校验尾号，18位会校验尾号，请务必在前端写好校验代码
    'customerNm' => '全渠道', //姓名
//   		'cvn2' => '248', //cvn2
//   		'expired' => '1912', //有效期，YYMM格式，持卡人卡面印的是MMYY的，请注意代码设置倒一下
);
//敏感信息加密证书路径(商户号开通了商户对敏感信息加密的权限，需要对 卡号accNo，pin和phoneNo，cvn2，expired加密（如果这些上送的话），对敏感信息加密使用)
$cert_path = '/Users/yao/Desktop/银联测试/测试环境证书/acp_test_enc.cer';
//$cert_path = '/Users/yao/Downloads/无跳转支付产品技术开发包V1.1.8/PHP Version SDK/token版/upacp_demo_wtz_token/assets/测试环境证书/acp_test_enc.cer';
$sign_cert_pwd = '000000';
$sign_cert_path='/Users/yao/Desktop/银联测试/测试环境证书/acp_test_sign.pfx';
//$sign_cert_path='/Users/yao/Downloads/无跳转支付产品技术开发包V1.1.8/PHP Version SDK/token版/upacp_demo_wtz_token/assets/测试环境证书/acp_test_sign.pfx';
$params = array(
    'version' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->version,
    'encoding' => 'utf-8',                  //编码方式
    'signMethod' => \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->signMethod,
    'txnType' => '79',                      //交易类型
    'txnSubType' => '00',                  //交易子类
    'bizType' => '000902',                  //业务类型
    'accessType' => '0',                  //接入类型
    'channelType' => '07',                  //渠道类型，07-PC，08-手机
    'encryptCertId' => \Apink\Payment\Unionpay\TokenPay\TokenPay::getEncryptCertId($cert_path),
    'frontUrl' => 'http://www.apinktara.cn',
    'backUrl' => 'http://www.apinktara.cn/composer/notify.php',
    'merId' => '777290058159786',
    'orderId' => date('YmdHis'),
    'txnTime' => date('YmdHis'),
    ////测试环境固定trId=62000000001&tokenType=01，生产环境由业务分配。测试环境因为所有商户都使用同一个trId，所以同一个卡获取的token号都相同，任一人发起更新token或者解除token请求都会导致原token号失效，所以之前成功、突然出现3900002报错时请先尝试重新开通一下。
    'tokenPayData' => '{trId=62000000001&tokenType=01}',
    'accNo' => \Apink\Payment\Unionpay\TokenPay\TokenPay::encryptData($accNo,$cert_path),
    'customerInfo' => \Apink\Payment\Unionpay\TokenPay\TokenPay::getCustomerInfoWithEncrypt($customerInfo,$cert_path),
    'payTimeout' => date('YmdHis', strtotime('+15 minutes'))
);
\Apink\Payment\Unionpay\Utils\TokenSign\Sign::sign($params,$sign_cert_path,$sign_cert_pwd);
$uri = \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->frontTransUrl;
$html_form = \Apink\Payment\Unionpay\TokenPay\TokenPay::getAutoFormHtml($params, $uri);
echo $html_form;


