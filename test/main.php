<?php

require "../vendor/autoload.php";

#测试号
$config = new \Config\Config("wx4eb905e777212235", "834573bf3a8887b3777154a32057f814");

$w = new \WeChat\WeChat($config);

$url = $w->WebAuth()->getCodeRedirect("http://www.wechat.com/auth.php");

header("location:" . $url);



