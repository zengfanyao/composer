<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 14:22
 */

require  __DIR__.'/vendor/autoload.php';
/**
 * 测试
 */
//$config = [
//    'mer_id' => '777290058110048',
//    'private_key_path' =>'/Users/yao/Desktop/银联测试/生产环境证书/acp_prod_enc.cer',
//    'private_key_pwd' => '000000',
//    'cert_dir' => '/Users/yao/Desktop/银联测试/生产环境证书',
//    'is_test' =>false
//];
//$out_trade_no = date('YmdHis') . '1' . rand(10000, 99999);
$webPay = new \Apink\Payment\Unionpay\WebPay();
//$return_params = [
//    'data' => 'lalal'
//];
//$params = array(
//    'backUrl' =>   'http://www.baidu.com/api/unicompay/notifies',      //后台通知地址
//    'frontUrl' =>   'http://www.baidu.com/api/unicompay/notifies',      //前台通知地址
//    'orderId' => $out_trade_no,    //商户订单号，8-32位数字字母，不能含“-”或“_”
//    'txnAmt' => 10,    //交易金额，单位分，
//    'reqReserved' => $webPay->setPassbackParams($return_params),        //请求方保留域，透传字段，查询、通知、对账文件中均会原样出现，如有需要请启用并修改自己希望透传的数据
//);
$res= $webPay->consume([]);
echo $res;

//\Apink\Payment\Unionpay\Utils\CertUtil::test();




