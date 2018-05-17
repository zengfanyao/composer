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
        static function sign(&$params,$cert_path,$cert_pwd){
            $params ['certId'] = CertUtil::getSignCertIdFromPfx($cert_path, $cert_pwd); //证书ID
            if (isset($params['signature'])) unset($params['signature']);
            //转换成key=val&字符串
            $params_str = self::createLinkString($params,true,false);
            $params_sha1x16 = sha1 ( $params_str, FALSE );
            $priavte_key = CertUtil::getSignKeyFromPfx($cert_path,$cert_pwd);
            //签名
            $sign_falg= openssl_sign($params_sha1x16,$signature,$priavte_key,OPENSSL_ALGO_SHA1);
            if(!$sign_falg){
                throw new \Exception( ">>>>>签名失败<<<<<<<" );
            }
            $signature_base64 = base64_encode ( $signature );
            $params ['signature'] = $signature_base64;
        }

        static function createAutoFormHtml($params,$reqUrl){
            // <body onload="javascript:document.pay_form.submit();">
            $encodeType = isset ( $params ['encoding'] ) ? $params ['encoding'] : 'UTF-8';
            $html = <<<eot
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={$encodeType}" />
</head>
<body onload="javascript:document.pay_form.submit();">
    <form id="pay_form" name="pay_form" action="{$reqUrl}" method="post">
	
eot;
            foreach ( $params as $key => $value ) {
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

        static function createLinkString($para,$sort,$encode){
            if ($para==NULL || !is_array($para)){
                return "";
            }
            $linkString ='';
            if($sort){
                $para=self::argSort($para);
            }
            foreach ($para as $key=>$value){
                if ($encode){
                    $value = urlencode($value);
                }
                $linkString.=$key.'='.$value.'&';
            }
            //去掉最后一个&
            $linkString =substr($linkString,0,count($linkString)-2);
            return $linkString;
        }
        static function argSort($para){
            ksort($para);
            reset($para);
            return $para;
        }
}