<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 15:09
 */

namespace Apink\Payment\Unionpay;


use Apink\Payment\Unionpay\Utils\Urls;

class WebPay extends BasePay
{
    /**
     * WebPay constructor.
     */
    public function __construct($config)
    {
        parent::__construct($config);
    }

    /**
     * 执行
     * @param $params
     * @return array
     * @throws PaymentException
     */
    public function handle($params)
    {
        return $this->consume();
    }

    /**
     * @return array|mixed|null
     * 单笔消费查询
     */
    public function queryHandle()
    {
        return $this->query();
    }

    /**
     * 验证签名
     */
    public function verify($params){
        return $this->validateSign($params);
    }

}