<?php


namespace Pay\contracts;


use Config\Config;
use Pay\config\PayConfig;
use Pay\notify\Notify;

interface PayInterface
{

    /**
     * 统一下单
     * Create by Peter Yang
     * 2021-07-24 15:32:19
     * @param UnifiedOrder $unifiedOrder
     * @return PayInterface
     */
    public function unifiedorder(UnifiedOrder $unifiedOrder): PayInterface;

    /**
     * 获取统一下单前端调用参数
     * Create by Peter Yang
     * 2021-07-24 15:32:29
     * @return array
     */
    public function getPayParameter():array;


    /**
     * 获取统一下单结果
     * Create by Peter Yang
     * 2021-07-24 15:32:51
     * @return array
     */
    public function getUnifiedorderResult(): array;


    public function check(string $data=""):Notify;


    public function SetConfig(Config $config);

    public function SetPayConfig(PayConfig $payConfig);

}