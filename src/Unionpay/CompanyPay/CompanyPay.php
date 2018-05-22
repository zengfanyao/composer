<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/21
 * Time: 21:11
 */

namespace Apink\Payment\Unionpay\CompanyPay;


use Apink\Payment\Unionpay\TokenPay\SDKConfig;
use Apink\Payment\Unionpay\TokenPay\TokenPay;
use Apink\Payment\Unionpay\Utils\AcpService;
use Apink\Payment\Unionpay\Utils\CertUtil;
use Apink\Payment\Unionpay\Utils\CompanyPay\CompanySign;

class CompanyPay
{
    /**
     * @param $params
     * @param $cert_path
     * @param $cert_pwd
     * @return string
     * 下单
     */
    static function frontConsume(&$params, $cert_path, $cert_pwd)
    {
        CompanySign::companySign($params, $cert_path, $cert_pwd);
        $uri = SDKConfig::getSDKConfig()->frontTransUrl;
        $html_form = TokenPay::getAutoFormHtml($params, $uri);
        return $html_form;
    }

    /**
     * 交易状态查询
     * Array
     * (
     * [accessType] => 0
     * [bizType] => 000000
     * [currencyCode] => 156
     * [encoding] => utf-8
     * [merId] => 777290058159786
     * [orderId] => 20180521212847
     * [origRespCode] => 00
     * [origRespMsg] => 成功[0000000]
     * [queryId] => 301805212128470220258
     * [respCode] => 00
     * [respMsg] => 成功[0000000]
     * [respTime] => 20180521212856
     * [settleAmt] => 1000
     * [settleCurrencyCode] => 156
     * [settleDate] => 0521
     * [signMethod] => 01
     * [traceNo] => 022025
     * [traceTime] => 0521212847
     * [txnAmt] => 1000
     * [txnSubType] => 01
     * [txnTime] => 20180521212847
     * [txnType] => 01
     * [version] => 5.1.0
     * [signPubKeyCert] => -----BEGIN CERTIFICATE-----
     * -----END CERTIFICATE-----
     * [signature] => RwXJGF2ucDf5rqdtuuabx+PpAaWOGJxeSSYOcWUQETKwPyc9NkfO4SoW9wYdc/x3GisWjH5ui1KxlKz9ddVvBrVNhT43Iu9u3U9t6gQBd46ecHKhG8X7xB1HjOVUhs6JE8OFqCRs6H/D13kgtbbvf6VDf6fxRu+NTW2nggzie58slYpsjA4X7Gz1no9QjCfWA5gnnS6lQsdRT6CaRAckIBV3TK/CAnMCr9JCBrd3akaHsSBMsF0DxEeVN1dHH9mwa5zoqR2sOUbpnStsssMB6e+YbqdBbbrT9GRuUHbBKVmhPCp+Sl+12RWUb/X9MeG+xyis2tfRelQdO+PxkNXv1A==
     * )
     */
    static function queryConsume(&$params, $cert_path, $cert_pwd)
    {
        CompanySign::companySign($params, $cert_path, $cert_pwd);
        $uri = SDKConfig::getSDKConfig()->singleQueryUrl;
        $result_arr = AcpService::query($params, $uri);
        return $result_arr;
    }

    /**
     * @param $params
     * @param $cert_path
     * @param $cert_pwd
     * 退货(退货)
     * Array
     * (
     * [accessType] => 0
     * [bizType] => 000201
     * [encoding] => utf-8
     * [merId] => 777290058159786
     * [orderId] => T201805212128471
     * [origQryId] => 301805212128470220258
     * [queryId] => 301805212128470221258
     * [respCode] => 00
     * [respMsg] => 成功[0000000]
     * [signMethod] => 01
     * [txnAmt] => 1000
     * [txnSubType] => 00
     * [txnTime] => 20180521212847
     * [txnType] => 04
     * [version] => 5.1.0
     * [signPubKeyCert] => -----BEGIN CERTIFICATE-----
     * -----END CERTIFICATE-----
     * [signature] => pWVquDPhK+WfUUisV1Pb5z1S0ez2t8CvRmFRgUgLP31ifi0crkJqsNj0yZvw+BrW6JuCtyUEOeP0PHDPWhrFjORNGKt7yBCWuOO3w9mEvac0tMdnF9BPOKUgZUn9tEdXQptivwLb1FEMVHP2S3vh9ctMgUdJXrwsRWqTCsGsg3DoAVOoQSmdpXA8y2D42iH5+6p2gcKF4lNIAlHx/MQCqp089pyMAdUaq/y4S5p2+rxoFnoyUMPf+/plLVrCpNq/GeL+AB9gCTZXhnjxQI92OAezPLSPtov9KCVD+XR3R5J7EJBI6YLyHrSkaGhHXb6sqXcXNlENZHnBzZGnivQx/A==
     * )
     */
    static function reFund(&$params, $cert_path, $cert_pwd)
    {
        CompanySign::companySign($params, $cert_path, $cert_pwd);
        $uri = SDKConfig::getSDKConfig()->backTransUrl;
        $result_arr = AcpService::query($params, $uri);
        return $result_arr;
    }

    /**
     * @param $data
     *
     */
    static function validate($params)
    {
        if ($params['signMethod'] == '01') {
            $signature_str = $params['signature'];
            unset($params['signature']);
            $params_str = AcpService::createLinkString($params, true, false);
            if ($params['version'] == '5.0.0') {
                //公钥
                $public_key = CertUtil::getVerifyCertByCertId($params['certId'], null);
                $signature = base64_decode($signature_str);
                $params_sha1x16 = sha1($params_str, FALSE);
                $isSuccess = openssl_verify($params_sha1x16, $signature, $public_key, OPENSSL_ALGO_SHA1);
            } else if ($params['version'] == '5.1.0') {
                $strCert = $params['signPubKeyCert'];
                $strCert = CertUtil::verifyAndGetVerifyCert($strCert);
                if ($strCert == null) {
                    $isSuccess = false;
                } else {
                    $params_sha256x16 = hash('sha256', $params_str);
                    $signature = base64_decode($signature_str);
                    $isSuccess = openssl_verify($params_sha256x16, $signature, $strCert, "sha256");
                }
            } else {
                $isSuccess = self::validateBySecureKey($params,SDKConfig::getSDKConfig()->secureKey);
            }
        }
        return $isSuccess;
    }

    static function validateBySecureKey($params, $secureKey)
    {
        $signature_str = $params['signature'];
        $params_str = AcpService::createLinkString($params, true, false);
        if ($params['signMethod'] == '11') {
            $params_before_sha256 = hash('sha256', $secureKey);
            $params_before_sha256 = $params_str . '&' . $params_before_sha256;
            $params_after_sha256 = hash('sha256', $params_before_sha256);
            $isSuccess = $params_after_sha256 == $signature_str;
        } else if ($params['signMethod'] == '12') {
            $isSuccess = false;
        } else {
            $isSuccess = false;
        }
        return $isSuccess;
    }
}