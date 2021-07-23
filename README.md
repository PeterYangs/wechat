
# 微信开发sdk

### 基本
1.获取access_token
```php
$w = new \WeChat\WeChat($config);

echo $w->getAccessToken();
```

### 网页授权

1.跳转页面获取code
```php
<?php

require "../vendor/autoload.php";

#配置信息
$config = new \Config\Config("appid", "appSecret",
    "回调地址");

$w = new \WeChat\WeChat($config);

$url = $w->WebAuth()->getCodeRedirect();

header("location:" . $url);
```

2.根据code获取用户信息
```php
<?php

require "../vendor/autoload.php";

$w = new \WeChat\WeChat($config);

$user_info = $w->WebAuth()->getUserInfoByCode($_GET['code']);


print_r($user_info);
```

### jsSdk
1.获取jsapiTicket
```php
$w = new \WeChat\WeChat($config);

$accessToken = $w->getAccessToken();


echo $w->JsSdk()->getTicket($accessToken);
```

2.wxConfig
```php
<?php

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


```


