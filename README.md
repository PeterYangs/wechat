
#微信开发sdk


####网页授权

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

