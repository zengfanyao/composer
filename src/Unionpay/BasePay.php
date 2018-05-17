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
    public $transUrl = 'https://101.231.204.80:5000/gateway/api/frontTransReq.do'; //交易请求地址
    //支付基本参数
    public $baseConsumeParams = array(
        //以下信息非特殊情况不需要改动
        //以下信息非特殊情况不需要改动
        'version' => '5.0.0',                 //版本号
        'encoding' => 'utf-8',				  //编码方式
        'txnType' => '01',				      //交易类型
        'txnSubType' => '01',				  //交易子类
        'bizType' => '000201',				  //业务类型
        'frontUrl' =>  'http://www.baidu.com',  //前台通知地址
        'backUrl' => 'http://www.baidu.com',	  //后台通知地址
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
    public function consume($get_params = [],$is_app=false){

        $get_params =array(
            'merId' =>'777290058110048',
            'orderId' => date('YmdHis'),
            'txnTime' => date('YmdHis'),
            'txnAmt' => '1000'
        );
        $params =array_merge($this->baseConsumeParams,$get_params);
        $cert_path ='/Users/yao/Downloads/网关支付产品技术开发包1.1.8/PHP Version SDK/upacp_demo_b2c/assets/测试环境证书/acp_test_sign.pfx';
        $cert_pwd ='000000';
        AcpService::sign($params,$cert_path,$cert_pwd);
        $html_form = AcpService::createAutoFormHtml($params, $this->transUrl);
        return  $html_form;
    }
}