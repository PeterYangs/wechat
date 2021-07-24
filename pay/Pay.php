<?php

namespace Pay;

use Config\Config;
use Pay\config\PayConfig;
use Pay\contracts\PayInterface;
use Pay\contracts\UnifiedOrder;
use Pay\notify\Notify;

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
     * Create by Peter Yang
     * 2021-07-24 14:42:12
     * @param UnifiedOrder $unifiedOrder
     * @return PayInterface
     * @throws \Exception
     */
    public function unifiedorder(UnifiedOrder $unifiedOrder): PayInterface
    {


        if (!$this->method) {

            throw new \Exception('请选择支付方式');
        }


        return $this->method->unifiedorder($unifiedOrder);
    }


    public function check(string $data = ""): Notify
    {

        if (!$this->method) {

            throw new \Exception('请选择支付方式');
        }


        return $this->method->check($data);

    }


}