<?php

namespace Pay;

use Config\Config;
use Pay\config\PayConfig;
use Pay\contracts\PayInterface;
use Pay\method\Method;

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


    /**
     * 选择支付方式
     * Create by Peter Yang
     * 2021-07-26 11:37:37
     * @param PayInterface $pay
     * @return Method
     */
    public function choose(PayInterface $pay): Method
    {


        $pay->SetConfig($this->config);

        $pay->SetPayConfig($this->payConfig);

        
        return new Method($pay);

    }


}