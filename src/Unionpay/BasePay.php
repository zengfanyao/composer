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

class BasePay extends BaseUnionpay
{
    public $transUrl;
    //支付基本参数
    public $baseConsumeParams = array(
        //以下信息非特殊情况不需要改动
        //以下信息非特殊情况不需要改动
        'version' => '5.0.0',                 //版本号
        'encoding' => 'utf-8',                  //编码方式
        'txnType' => '01',                      //交易类型
        'txnSubType' => '01',                  //交易子类
        'bizType' => '000201',                  //业务类型
        'signMethod' => '01',                  //签名方法
        'channelType' => '08',                  //渠道类型，07-PC，08-手机
        'accessType' => '0',                  //接入类型
        'currencyCode' => '156',              //交易币种，境内商户固定156
    );
    /**
     * @var array
     * 交易状态查询
     */
    public $baseQueryParams = array(
        //以下信息非特殊情况不需要改动
        'version' => '5.0.0',          //版本号
        'encoding' => 'utf-8',          //编码方式
        'signMethod' => '01',          //签名方法
        'txnType' => '00',              //交易类型
        'txnSubType' => '00',          //交易子类
        'bizType' => '000000',          //业务类型
        'accessType' => '0',          //接入类型
        'channelType' => '07',          //渠道类型
    );

    /**
     * @param array $get_params
     * @param bool $is_app
     * 消费接口
     */
    public function consume()
    {
        $params = array_merge($this->baseConsumeParams, $this->config);
        AcpService::sign($params);
        $this->transUrl = BasePay::$urls['SDK_FRONT_TRANS_URL'];
        $html_form = AcpService::createAutoFormHtml($params, $this->transUrl);
        return $html_form;
    }

    /**
     * 交易状态查询(单条)
     */
    public function query()
    {
        $params = array_merge($this->baseQueryParams, $this->config);
        AcpService::sign($params);
        $this->transUrl = BasePay::$urls['SDK_SINGLE_QUERY_URL'];
        $result_arr = AcpService::query($params, $this->transUrl);
        if (count($result_arr) <= 0) {
            return null;
        }
        return $result_arr;
    }

    //应答报文验证
    public function validateSign($result_arr)
    {
        $isSuccess = AcpService::validate($result_arr, $this->config['certPath'], $this->config['certPwd']);
        if (!$isSuccess) return false;
        //判断交易状态   判断respCode=00或A6即可认为交易成功
        if (empty($data['respCode']) || !in_array($data['respCode'], ['00', 'A6'])) {
            throw new \Exception('交易失败!');
        }
        return $result_arr;
    }

    /**
     * 回复成功
     */
    public function returnSuccess(){
        echo 'success';
    }
    /**
     * @throws \Exception
     * 回复失败
     */
    public function returnFailure(){
        throw new \Exception("failure");
    }
}