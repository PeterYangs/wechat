<?php

namespace Web\auth;


use Config\Config;
use GuzzleHttp\Client;


class Auth
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
     * 获取拿code的地址
     * Create by Peter Yang
     * 2021-07-22 15:51:15
     * @return string
     */
    public function getCodeRedirect()
    {


        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->config->getAppId() . "&redirect_uri=" . urlencode($this->config->getRedirectUri()) . "&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";

    }


    /**
     * 通过code获取用户信息
     * Create by Peter Yang
     * 2021-07-22 16:42:11
     * @param $code
     * @return mixed
     * @throws \Exception|array
     */
    public function getUserInfoByCode($code)
    {


        if (!$code) {

            throw new \Exception("code不能为空");
        }


        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->config->getAppId() . "&secret=" . $this->config->getAppSecret() . "&code=" . $code . "&grant_type=authorization_code";


        $access_token = $this->http->get($url)->getBody()->getContents();


        $access_token = json_decode($access_token, true);

        if ($re['errcode'] ?? null) {

            throw new \Exception(json_encode($access_token));

        }

        $openid = $access_token['openid'];

        $access_token = $access_token['access_token'];


        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";


        $user_info = $this->http->get($url)->getBody()->getContents();

        $user_info = json_decode($user_info, true);

        if ($user_info['errcode'] ?? null) {

            throw new \Exception(json_encode($user_info));

        }


        return $user_info;

    }

}