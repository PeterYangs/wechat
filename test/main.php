<?php

require "../vendor/autoload.php";


$w=new \WeChat\WeChat("wx4eb905e777212235","834573bf3a8887b3777154a32057f814");


$url=$w->WebAuth("https://www.baidu.com")->getCodeRedirect();

echo $url;




//echo $w->getAppId();


