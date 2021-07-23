<?php
require "../vendor/autoload.php";

$config = new \Config\Config("wx4eb905e777212235", "834573bf3a8887b3777154a32057f814",
    "http://www.wechat.com/auth.php");

$w = new \WeChat\WeChat($config);

$accessToken = $w->getAccessToken();

$jsSdk = $w->JsSdk();

$ticket = $jsSdk->getTicket($accessToken);

$wxConfig = $jsSdk->getWxConfig($ticket, "http://www.wechat.com/wxConfig.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="jweixin-1.6.0.js"></script>
</head>
<body>
<script>
    wx.config({
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '<?php echo $config->getAppId();?>', // 必填，公众号的唯一标识
        timestamp: <?php echo $wxConfig->getTimestamp() ?>, // 必填，生成签名的时间戳
        nonceStr: '<?php echo $wxConfig->getNonceStr() ?>', // 必填，生成签名的随机串
        signature: '<?php echo $wxConfig->getSignature() ?>',// 必填，签名
        jsApiList: ['chooseImage'] // 必填，需要使用的JS接口列表
    });
</script>
</body>
</html>

