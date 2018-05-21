<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/21
 * Time: 10:23
 */

namespace Apink\Payment\Unionpay\TokenPay;

use Apink\Payment\Unionpay\Utils\AcpService;
use Apink\Payment\Unionpay\Utils\CertUtil;
use Apink\Payment\Unionpay\Utils\TokenSign\Sign;
use Exception;

class TokenPay
{
    public static function getAutoFormHtml($params, $uri)
    {
        $html = self::createAutoFormHtml($params, $uri);
        return $html;
    }

    static function getEncryptCertId($cert_path)
    {
        return CertUtil::getEncryptCertId($cert_path);
    }

    static function encryptData($data, $cert_path = null)
    {
        if (empty($cert_path)) {
            throw new Exception("数据为空");
        }
        $public_key = CertUtil::getEncryptKey($cert_path);
        openssl_public_encrypt($data, $crypted, $public_key);
        return base64_encode($crypted);
    }

    static function getCustomerInfoWithEncrypt($customerInfo, $cert_path)
    {
        if ($customerInfo == null || count($customerInfo) == 0) {
            throw new Exception("参数为空");
        }
        $encryptedInfo = [];
        foreach ($encryptedInfo as $key => $value) {
            if ($key == 'phoneNo' || $key == 'cvn2' || $key == 'expired') {
                //if ($key == 'phoneNo' || $key == 'cvn2' || $key == 'expired' || $key == 'certifTp' || $key == 'certifId') {
                $encryptedInfo [$key] = $customerInfo [$key];
                unset ($customerInfo [$key]);
            }
        }
        if (count($encryptedInfo) > 0) {
            $encryptedInfo = AcpService::createLinkString($encryptedInfo, false, false);
            $encryptedInfo = self::encryptData($encryptedInfo, $cert_path);
            $customerInfo['encryptedInfo'] = $encryptedInfo;
        }
        return base64_encode("{" . AcpService::createLinkString($customerInfo, false, false) . "}");
    }

    static function createAutoFormHtml($params, $reqUrl)
    {
        // <body onload="javascript:document.pay_form.submit();">
        $encodeType = isset ($params ['encoding']) ? $params ['encoding'] : 'UTF-8';
        $html = <<<eot
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={$encodeType}" />
</head>
<body onload="javascript:document.pay_form.submit();">
    <form id="pay_form" name="pay_form" action="{$reqUrl}" method="post">
	
eot;
        foreach ($params as $key => $value) {
            $html .= "    <input type=\"hidden\" name=\"{$key}\" id=\"{$key}\" value=\"{$value}\" />\n";
        }
        $html .= <<<eot
   <!-- <input type="submit" type="hidden">-->
    </form>
</body>
</html>
eot;
        return $html;
    }
}