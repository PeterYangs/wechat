<?php
require "../vendor/autoload.php";


$config = new \Config\Config("wx4eb905e777212235", "834573bf3a8887b3777154a32057f814");

$w = new \WeChat\WeChat($config);

$accessToken = $w->getAccessToken();


echo $w->JsSdk()->getTicket($accessToken);

