<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 16:06
 */

namespace Apink\Payment\Unionpay\Utils;


class AcpService
{
    /**
     * @param $params
     * @param $cert_path
     * @param $cert_pwd
     * 请求要素
     */
    static function sign(&$params)
    {
        $cert_path = $params['certPath'];
        $cert_pwd = $params['certPwd'];
        $params ['certId'] = CertUtil::getSignCertIdFromPfx($cert_path, $cert_pwd); //证书ID
        if (isset($params['signature'])) unset($params['signature']);
        if (isset($params['certPath'])) unset($params['certPath']);
        if (isset($params['certPwd'])) unset($params['certPwd']);
        //转换成key=val&字符串
        $params_str = self::createLinkString($params, true, false);
        $params_sha1x16 = sha1($params_str, FALSE);
        $priavte_key = CertUtil::getSignKeyFromPfx($cert_path, $cert_pwd);
        //签名
        $sign_falg = openssl_sign($params_sha1x16, $signature, $priavte_key, OPENSSL_ALGO_SHA1);
        if (!$sign_falg) {
            throw new \Exception(">>>>>签名失败<<<<<<<");
        }
        $signature_base64 = base64_encode($signature);
        $params ['signature'] = $signature_base64;
    }

    /**
     * 查询单笔交易
     */
    static function query($params, $reqUrl)
    {
        $opts = self::createLinkString($params, false, true);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $reqUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 不验证证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 不验证HOST
        curl_setopt($ch, CURLOPT_SSLVERSION, 1); // http://php.net/manual/en/function.curl-setopt.php页面搜CURL_SSLVERSION_TLSv1
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type:application/x-www-form-urlencoded;charset=UTF-8'
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $opts);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);
        if (curl_errno($ch)) {
            $errmsg = curl_error($ch);
            curl_close($ch);
            throw new \Exception("请求失败，报错信息>" . $errmsg);
        }
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE != "200")) {
            curl_close($ch);
            throw new \Exception("http状态=" . curl_getinfo($ch, CURLINFO_HTTP_CODE));
        }
        curl_close($ch);
        $result_arr = self::convertStringToArray($html);
        return $result_arr;
    }

    static function convertStringToArray($str)
    {
        return Common::parseQString($str);
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

    //验证签名
    static function validate($params,$certDir)
    {
        file_put_contents("/usr/local/nginx/html/union.txt",json_encode('validate'),FILE_APPEND);
        file_put_contents("/usr/local/nginx/html/union.txt",json_encode($params),FILE_APPEND);
        //公钥
        $public_key = CertUtil::getVerifyCertByCertId($params['certId'],$certDir);
        //签名串
        $signature_str = $params ['signature'];
        unset($params['signature']);
        $params_str = self::createLinkString($params, true, false);
        $signature = base64_decode($signature_str);
        $params_sha1x16 = sha1($params_str, FALSE);
        $isSuccess = openssl_verify($params_sha1x16, $signature, $public_key, OPENSSL_ALGO_SHA1);
        return $isSuccess;
    }

    static function createLinkString($para, $sort, $encode)
    {
        if ($para == NULL || !is_array($para)) {
            return "";
        }
        $linkString = '';
        if ($sort) {
            $para = self::argSort($para);
        }
        foreach ($para as $key => $value) {
            if ($encode) {
                $value = urlencode($value);
            }
            $linkString .= $key . '=' . $value . '&';
        }
        //去掉最后一个&
        $linkString = substr($linkString, 0, count($linkString) - 2);
        return $linkString;
    }

    static function argSort($para)
    {
        ksort($para);
        reset($para);
        return $para;
    }
}