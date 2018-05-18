<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 2018/5/17
 * Time: 15:09
 */

namespace Apink\Payment\Unionpay;


class WebPay extends BasePay
{
    /**
     * WebPay constructor.
     */
    public $debug=true;
    public function __construct($config)
    {
        parent::__construct($config);
        //判断是否测试环境
        if($this->debug){
            $this->transUrl = 'https://gateway.test.95516.com/gateway/api/frontTransReq.do';
        }
        else{
            $this->transUrl = 'https://gateway.95516.com/gateway/api/frontTransReq.do';
        }
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
}