<?php

require "../vendor/autoload.php";

#测试号
$config = new \Config\Config("wx4eb905e777212235", "834573bf3a8887b3777154a32057f814", "https://www.baidu.com");


$w = new \WeChat\WeChat($config);

$user_info = $w->WebAuth()->getUserInfoByCode($_GET['code']);


print_r($user_info);