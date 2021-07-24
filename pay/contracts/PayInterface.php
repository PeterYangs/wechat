<?php


namespace Pay\contracts;


use Config\Config;
use Pay\config\PayConfig;

interface PayInterface
{

    public function unifiedorder(UnifiedOrder $unifiedOrder): PayInterface;

    public function getPayParameter():array;

    public function getUnifiedorderResult(): array;

    public function SetConfig(Config $config);

    public function SetPayConfig(PayConfig $payConfig);

}