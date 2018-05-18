<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 14:56
 */

namespace Apink\Payment\Unionpay;


use Apink\Payment\Unionpay\Utils\AcpService;
use Apink\Payment\Unionpay\Utils\CertUtil;

class BasePay extends  BaseUnionpay
{
    public $transUrl ;
    //支付基本参数
    public $baseConsumeParams = array(
        //以下信息非特殊情况不需要改动
        //以下信息非特殊情况不需要改动
        'version' => '5.0.0',                 //版本号
        'encoding' => 'utf-8',				  //编码方式
        'txnType' => '01',				      //交易类型
        'txnSubType' => '01',				  //交易子类
        'bizType' => '000201',				  //业务类型
        'signMethod' => '01',	              //签名方法
        'channelType' => '08',	              //渠道类型，07-PC，08-手机
        'accessType' => '0',		          //接入类型
        'currencyCode' => '156',	          //交易币种，境内商户固定156
    );
    /**
     * @param array $get_params
     * @param bool $is_app
     * 消费
     */
    public function consume(){
        $params =array_merge($this->baseConsumeParams,$this->config);
        AcpService::sign($params);
        $html_form = AcpService::createAutoFormHtml($params, $this->transUrl);
        return  $html_form;
    }
}