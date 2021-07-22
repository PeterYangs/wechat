<?php

namespace WebAuth;


class Auth
{

    /**
     * @var string
     */
    protected $appId;

    /**
     * @var string
     */
    protected $appSecret;

    /**
     * @var string 授权地址
     */
    protected $redirectUri;

    /**
     * Auth constructor.
     * @param string $appId
     * @param string $appSecret
     * @param string $redirectUri
     */
    public function __construct($appId, $appSecret, $redirectUri)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->redirectUri = $redirectUri;
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * 获取拿code的地址
     * Create by Peter Yang
     * 2021-07-22 15:51:15
     * @return string
     */
    public function getCodeRedirect()
    {


        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appId . "&redirect_uri=" . urlencode($this->redirectUri) . "&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";

    }


}