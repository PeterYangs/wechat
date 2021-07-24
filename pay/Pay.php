<?php

namespace Pay;

use Config\Config;
use Pay\config\PayConfig;
use Pay\contracts\PayInterface;

class Pay
{


    /**
     * @var PayConfig
     */
    protected $payConfig;


    /**
     * @var Config
     */
    protected $config;


    /**
     * @var PayInterface
     */
    protected $method;

    /**
     * Pay constructor.
     * @param PayConfig $payConfig
     * @param Config $config
     */
    public function __construct(PayConfig $payConfig, Config $config)
    {
        $this->payConfig = $payConfig;
        $this->config = $config;
    }


    public function choose(PayInterface $pay)
    {


        $pay->SetConfig($this->config);

        $pay->SetPayConfig($this->payConfig);

        $this->method = $pay;

        return $this;
    }


    /**
     * 统一下单接口
     * Create by Peter Yang
     * 2021-07-24 09:49:34
     * @return mixed
     * @throws \Exception
     */
    public function unifiedorder()
    {


        if (!$this->method) {

            throw new \Exception('请选择支付方式');
        }


        return $this->method->unifiedorder();
    }


}