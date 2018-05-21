<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/21
 * Time: 09:42
 */

namespace Apink\Payment\Unionpay\Utils\TokenSign;

use Apink\Payment\Unionpay\TokenPay\SDKConfig;
use Apink\Payment\Unionpay\Utils\AcpService;
use Apink\Payment\Unionpay\Utils\CertUtil;
use Exception;

class Sign
{
    /**
     * @param $params
     * 签名
     */
    static function sign(&$params, $cert_path, $cert_pwd)
    {

        if ($params['signMethod'] == '01') {
            return self::signByCertInfo($params, $cert_path, $cert_pwd);
        } else {
            return self::signBySecureKey($params);
        }
    }

    static function signByCertInfo(&$params, $cert_path, $cert_pwd)
    {
        if (isset($params['signature'])) unset($params['signature']);
        $result = false;
        if ($params['signMethod'] == '01') {
            $params['certId'] = CertUtil::getSignCertIdFromPfx($cert_path, $cert_pwd); //正式ID

            $private_key = CertUtil::getSignKeyFromPfx($cert_path, $cert_pwd);

            $params_str = AcpService::createLinkString($params, true, false);

            if ($params['version'] == '5.0.0') {
                $params_sha1x16 = sha1($params_str, FALSE);
                //签名
                $result = openssl_sign($params_sha1x16, $signature, $private_key, OPENSSL_ALGO_SHA1);
                if ($result) {
                    $signature_base64 = base64_encode($signature);
                    $params ['signature'] = $signature_base64;

                }
            } else if ($params['version'] == '5.1.0') {
                $params_sha256x16 = hash('sha256', $params_str);
                $result = openssl_sign($params_sha256x16, $signature, $private_key, 'sha256');
                if ($result) {
                    $signature_base64 = base64_encode($signature);
                    $params ['signature'] = $signature_base64;
                } else {
                    throw new Exception("签名失败");
                }
            }
        } else {
            return false;
        }
        return $result;
    }

    static function signBySecureKey(&$params, $secureKey = null)
    {
        if ($params['signMethod'] == '11') {
            $params_str = AcpService::createLinkString($params, true, false);
            $params_before_sha256 = hash('sha256', $secureKey);
            $params_before_sha256 = $params_str . '&' . $params_before_sha256;
            $params_after_sha256 = hash('sha256', $params_before_sha256);
            $params ['signature'] = $params_after_sha256;
            $result = true;
        } else if ($params['signMethod'] == '12') {
            $result = false;
        } else {
            $result = false;
        }
        return $result;
    }

}