
# 微信开发sdk

### 安装
```shell
composer require peteryang/wechat
```

### 基本
1.获取access_token
```php

#配置信息
$config = new \Config\Config("appid", "appSecret","回调地址");

$w = new \WeChat\WeChat($config);

echo $w->getAccessToken();
```

### 网页授权

1.跳转页面获取code
```php
<?php

require "../vendor/autoload.php";

#配置信息
$config = new \Config\Config("appid", "appSecret","回调地址");

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
### 微信公众号支付
调起支付
```php
<?php


use Pay\config\PayConfig;
use Pay\method\js\Js;
use Pay\method\js\JsUnifiedOrder;

require "../vendor/autoload.php";

#测试号
$config = new \Config\Config("appid", "appkey","http://www.wechat.com/auth.php");

$w = new \WeChat\WeChat($config);

#获取access_token
$accessToken = $w->getAccessToken();

$jsSdk = $w->JsSdk();

#获取ticket
$ticket = $jsSdk->getTicket($accessToken);

#获取jssdk配置项
$wxConfig = $jsSdk->getWxConfig($ticket, "http://www.wechat.com/wxConfig.php");


#微信支付实例
$pay = $w->pay(new PayConfig("商户id", "商户秘钥"));

#选择支付方式
$method = $pay->choose(new Js());

#调用统一下单
$payParameter = $method->unifiedorder(new JsUnifiedOrder(
    "商品描述",
    "订单号",
    1,
    "ip",
    "通知地址",
    "openid",
    "附加数据"
))->getPayParameter();


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


    wx.ready(function () {
        // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
        wx.chooseWXPay({
            timestamp: <?php echo $payParameter['timeStamp'];?>, // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
            nonceStr: '<?php echo $payParameter['nonceStr'];?>', // 支付签名随机串，不长于 32 位
            package: '<?php echo $payParameter['package'];?>', // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=\*\*\*）
            signType: '<?php echo $payParameter['signType'];?>', // 微信支付V3的传入RSA,微信支付V2的传入格式与V2统一下单的签名格式保持一致
            paySign: '<?php echo $payParameter['paySign'];?>', // 支付签名
            success: function (res) {
                // 支付成功后的回调函数


            }
        });


    });


</script>
</body>
</html>
```

通知检查
```php
<?php

require "../vendor/autoload.php";


try {


    #测试号
    $config = new \Config\Config("appid", "appkey","http://www.wechat.com/auth.php");

    $w = new \WeChat\WeChat($config);


    $pay = $w->pay(new \Pay\config\PayConfig("xxxxx", "xxxx"));

    $method = $pay->choose(new \Pay\method\js\Js());

    #验证失败会抛出异常，验证成功返回回调数据
    $all=$method->check()->getAll();


} catch (\Exception $exception) {


    echo $exception->getMessage();

}
```


