<?php

require "../vendor/autoload.php";


try {


    #测试号
    $config = new \Config\Config("wx4eb905e777212235", "834573bf3a8887b3777154a32057f814");

    $w = new \WeChat\WeChat($config);


    $pay = $w->pay(new \Pay\config\PayConfig("xxxxx", "xxxx"));

    $method = $pay->choose(new \Pay\method\js\Js());

    #验证失败会抛出异常，验证成功返回回调数据
    $all=$method->check()->getAll();


} catch (\Exception $exception) {


    echo $exception->getMessage();

}