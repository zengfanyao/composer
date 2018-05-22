<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/21
 * Time: 21:01
 */

namespace Apink\Payment\Unionpay\Utils\CompanyPay;


use Apink\Payment\Unionpay\Utils\TokenSign\Sign;

class CompanySign
{
    static function companySign(&$params,$cert_path, $cert_pwd){
        return Sign::sign($params,$cert_path,$cert_pwd);
    }

}