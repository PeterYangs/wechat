<?php


namespace Pay\contracts;


use Config\Config;
use Pay\config\PayConfig;

interface PayInterface
{

    function unifiedorder();

    function SetConfig(Config $config);

    function  SetPayConfig(PayConfig $payConfig);

}