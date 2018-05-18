<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 16:09
 */

namespace Apink\Payment\Unionpay\Utils;


class CertUtil
{
    private static $signCerts = array();
    private static $encryptCerts = array();
    private static $verifyCerts = array();

    private static function initSignCert($certPath, $certPwd)
    {
        $cert = new Cert();
        $pkcs12certdata = file_get_contents($certPath);
        if ($pkcs12certdata === false) {
            throw new \Exception("读取文件失败");
        }
        openssl_pkcs12_read($pkcs12certdata, $certs, $certPwd);
        $x509data = $certs ['cert'];
        $certdata = openssl_x509_parse($x509data);
        $cert->certId = $certdata ['serialNumber'];
        $cert->key = $certs ['pkey'];
        $cert->cert = $x509data;
        CertUtil::$signCerts[$certPath] = $cert;
    }

    public static function getSignKeyFromPfx($certPath, $certPwd)
    {
        if (!array_key_exists($certPath, CertUtil::$signCerts)) {
            self::initSignCert($certPath, $certPwd);
        }
        return CertUtil::$signCerts[$certPath]->key;
    }

    public static function getSignCertIdFromPfx($certPath, $certPwd)
    {
        if (!array_key_exists($certPath, CertUtil::$signCerts)) {
            self::initSignCert($certPath, $certPwd);
        }
        return CertUtil::$signCerts[$certPath]->certId;
    }

    private static function initEncryptCert($cert_path)
    {
        $cert = new Cert();
        $x509data = file_get_contents($cert_path);
        if ($x509data === false) {
            throw new \Exception($cert_path . "读取失败。");
        }

        openssl_x509_read($x509data);
        $certdata = openssl_x509_parse($x509data);
        $cert->certId = $certdata ['serialNumber'];
        $cert->key = $x509data;
        CertUtil::$encryptCerts[$cert_path] = $cert;
    }

    public static function getEncryptCertId($cert_path = SDK_ENCRYPT_CERT_PATH)
    {
        if (!array_key_exists($cert_path, CertUtil::$encryptCerts)) {
            self::initEncryptCert($cert_path);
        }
        return CertUtil::$encryptCerts[$cert_path]->certId;
    }

    public static function getEncryptKey($cert_path = SDK_ENCRYPT_CERT_PATH)
    {
        if (!array_key_exists($cert_path, CertUtil::$encryptCerts)) {
            self::initEncryptCert($cert_path);
        }
        return CertUtil::$encryptCerts[$cert_path]->key;
    }

    private static function initVerifyCerts($cert_dir)
    {
        $handle = opendir($cert_dir);
        if (!$handle) {
            throw new \Exception('证书目录 ' . $cert_dir . '不正确');
        }
        while ($file = readdir($handle)) {
            clearstatcache();
            $filePath = $cert_dir . '/' . $file;
            if (!is_file($filePath)) continue;
            if (pathinfo($file, PATHINFO_EXTENSION) == 'cer') {
                $x509data = file_get_contents($filePath);
                if ($x509data === false) {
                    throw new \Exception("$filePath". "读取失败");
                }
                $cert = new Cert();
                openssl_x509_read($x509data);
                $certdata = openssl_x509_parse($x509data);
                $cert->certId = $certdata ['serialNumber'];
                $cert->key = $x509data;
                CertUtil::$verifyCerts[$cert->certId] = $cert;
            }
        }
        closedir($handle);
    }
    public static function getVerifyCertByCertId($certId,$certDir=''){
        file_put_contents("/usr/local/nginx/html/union.txt",json_encode('getVerifyCertByCertId'),FILE_APPEND);
        if(count(CertUtil::$verifyCerts) == 0){
            self::initVerifyCerts($certDir);
        }
        if(count(CertUtil::$verifyCerts) == 0){
            throw new \Exception("未读取到任何证书……");
        }
        file_put_contents("/usr/local/nginx/html/union.txt",json_encode('$certId--'.$certId),FILE_APPEND);
        file_put_contents("/usr/local/nginx/html/union.txt",json_encode(CertUtil::$verifyCerts),FILE_APPEND);
        if(array_key_exists($certId, CertUtil::$verifyCerts)){
            return CertUtil::$verifyCerts[$certId]->key;
        } else {
            throw new \Exception("未匹配到序列号为[" . certId . "]的证书");
        }
    }
    public static function test() {

        $x509data = file_get_contents ( "/Users/yao/Desktop/银联测试/生产环境证书/acp_prod_enc.cer");
// 		$resource = openssl_x509_read ( $x509data );
        // $certdata = openssl_x509_parse ( $resource ); //<=这句尼玛内存泄漏啊根本释放不掉啊啊啊啊啊啊啊
        // echo $certdata ['serialNumber']; //<=就是需要这个数据啦
        // echo $x509data;
        // unset($certdata); //<=没有什么用
        // openssl_x509_free($resource); //<=没有什么用x2
        echo CertSerialUtil::getSerial ( $x509data, $errMsg ) . "\n";
    }
}