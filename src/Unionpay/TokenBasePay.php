<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/21
 * Time: 16:51
 */

namespace Apink\Payment\Unionpay;


use Apink\Payment\Unionpay\Utils\AcpService;
use Apink\Payment\Unionpay\Utils\CertUtil;

class TokenBasePay
{
    /**
     * 银行侧开通开通token 支付
     */
    public static function bankOpenToken(&$params, $sign_cert_path, $sign_cert_pwd)
    {
        \Apink\Payment\Unionpay\Utils\TokenSign\Sign::sign($params, $sign_cert_path, $sign_cert_pwd);
        $uri = \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->frontTransUrl;
        $html_form = \Apink\Payment\Unionpay\TokenPay\TokenPay::getAutoFormHtml($params, $uri);
        return $html_form;
    }

    /**
     * 银联开通状态查询
     * Array
    (
    [accNo] => OyVXCiwN5aR9aB9stnnhRXJu803ZhLI2kA60zA9FDpFPSxy/jdgRhK5rTa0SZjylqN0lkVbi0HjvT+MJ5o3XO+JIKLSrbHU5wAebBrwuuOJUg4FPEUID+G7v4i3x+hN81RMdKpHtPqRk11zUET6V/eEsL/dPtsYkAdESbOwZ8j9H5fEbuJasoBKiDsN+8j5ghPoD0L4ID+XSe0xG/bqh3twGuNkgQn5WBwtVTqj6A6gk6VyDTN0cDKI1JQkLp9keWOxWJ+eM2Mf5wOEPeeBEvh4Hb273L9d3tS0X7OZTJ1XE1wT8bVC1p7SkDlYzT062+creHykOHsXWOIVgfV5W5w==
    [accessType] => 0
    [activateStatus] => 1
    [bizType] => 000902
    [customerInfo] => e2VuY3J5cHRlZEluZm89cEtIaE5vTjlsa043UW81WnczZHNjT1JNeFovY29XdkNkY2ZVZU9TQUlLMG04NmtFZlNTcWllYkExNkV6OUZPVUxGdXJwYzY2TEg1Q1lMTkkwT3NDMEtuZnRyZ2N6cmdzdS8yT29abldveDFOZTBYdXZZbzBGeVFxVUV4MVVBWVFQVjdSRkZKVTlHU1ZGTlZBd3ZsZTFYV1BXY2plcmNPcktGZ283bkV3SlZScHI2YkhNa2hGUzRaUjFFWmYxY2xKZ1lzRHZ2eVhsS3JIUkc4K0dBYVhRSUpncGtDWlpGeU1rNFZxMXB4ZkMrL1Vsd3FiTTFiSkE2dW15cmpXNHBLdVdzbG1MbFBVQmVncWN2aTZBMTdkZzM3aXVPSm1JWGNCa3RpUng5WnkvTnlQNFVMK1lzdDRqNjlRWHpLSmNtQkdxSmRUdWJDQVdvV0t1WWh3dkIzaXFBPT19
    [encoding] => utf-8
    [merId] => 777290058159786
    [orderId] => 20180521194931
    [payCardType] => 01
    [respCode] => 00
    [respMsg] => 成功[0000000]
    [signMethod] => 01
    [tokenPayData] => {token=6235240000020833311&tokenBegin=20180521194958&tokenEnd=20230520194958&tokenLevel=10&tokenType=01&trId=62000000001}
    [txnSubType] => 02
    [txnTime] => 20180521194931
    [txnType] => 78
    [version] => 5.1.0
    [signPubKeyCert] => -----BEGIN CERTIFICATE-----
    [signature] => R1s4WxzbfmwvLQd+sfq8YoYA5lMew2STEPYTL4aW3U/1T82ilGykrLJ34wJMNRlVhJPJggDjs3mXLkaIt4Uqdtm5qcf1NSFtSZZ5g2q7/sL5TIoVEeng1P2ElwLq4uGMEgmSc69g7Dd4E3B2mWbVmDZePxHbtzZE+Ft+15Sh/m5oOeqAlSRNWq/LjfrV/cSNMxTw1/mUewbWZF7566WGYPC1Kg4tUw5yG6yFGDdqekV4OQsJEiKDGpOcHAEm4xMr9mR/uBqbARJ7ZC25vOklF6z9hnPOa8dLDhub1EMzPtz0kcG9CCuMCYvwRF9cY/wgu3zxpeQDmVQXnfOyDQM1NQ==
    )
     */
    public static function bankTokenStatus(&$params, $sign_cert_path, $sign_cert_pwd)
    {
        \Apink\Payment\Unionpay\Utils\TokenSign\Sign::sign($params, $sign_cert_path, $sign_cert_pwd);
        $url = \Apink\Payment\Unionpay\TokenPay\SDKConfig::getSDKConfig()->backTransUrl;
        $result_arr = AcpService::query($params, $url);
        if (count($result_arr) <= 0) { //没收到200应答的情况
            return;
        }
        if ($result_arr['respCode'] =='00'){
            echo  "开通成功";
        }else {
            throw new \Exception("开通失败");
        }
        return $result_arr;
    }
}