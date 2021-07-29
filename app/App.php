<?php

namespace App;

use Config\Config;
use GuzzleHttp\Client;
use WeChat\SessionDao;

class App
{


    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Client
     */
    protected $http;

    /**
     * WeChat constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;

        $this->http = new Client();
    }


    /**
     * 获取小程序session
     * Create by Peter Yang
     * 2021-07-29 15:33:11
     * @throws \Exception
     */
    public function getSession(string $code): SessionDao
    {

        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=" . $this->config->getAppId() . "&secret=" . $this->config->getAppSecret() . "&js_code=" . $code . "&grant_type=authorization_code";


        $re = $this->http->get($url)->getBody()->getContents();


        $re = json_decode($re, true);

        if ($re['errcode']??0 !== 0) {

            throw new \Exception(json_encode($re));

        }

        return new SessionDao($re['openid'], $re['session_key'], $re['unionid']??"");


    }


    /**
     * 解密数据获取用户信息
     * Create by Peter Yang
     * 2021-07-29 15:53:29
     * @throws \Exception
     */
    public function decryptData($encryptedData, $iv, $sessionKey): UserDao
    {


        if (strlen($sessionKey) !== 24) {

            throw new \Exception('session_key长度异常');
        }

        $aesKey = base64_decode($sessionKey);


        if (strlen($iv) !== 24) {
            throw new \Exception('iv长度异常');
        }
        $aesIV = base64_decode($iv);

        $aesCipher = base64_decode($encryptedData);

        $result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

        $dataObj = json_decode($result, true);


        if (!$dataObj) {

            throw new \Exception('解密失败');
        }

        if ($dataObj['watermark']['appid'] !== $this->config->getAppId()) {


            throw new \Exception('解密中的appid和配置的不一致！');
        }


        return new UserDao($dataObj['openId'], $dataObj['nickName'], $dataObj['gender'], $dataObj['language'],
            $dataObj['city'], $dataObj['province'], $dataObj['country'], $dataObj['avatarUrl'], $dataObj['unionId'],
            $dataObj['watermark']['appid']);


    }


}