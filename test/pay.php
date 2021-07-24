<?php

require "../vendor/autoload.php";


try {


    #测试号
    $config = new \Config\Config("wx4eb905e777212235", "834573bf3a8887b3777154a32057f814",
        "http://www.wechat.com/auth.php");

    $w = new \WeChat\WeChat($config);


    $pay = $w->pay(new \Pay\config\PayConfig("xxxxx", "xxxx"));

    $method = $pay->choose(new \Pay\method\js\Js("1312", "23131", "1", "12", "", ""));

    echo $pay->unifiedorder();

} catch (\Exception $exception) {


    echo $exception->getMessage();

}