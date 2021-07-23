<?php


namespace Web\jsSdk;


use Config\Config;
use GuzzleHttp\Client;
use Tool\Tool;

class JsSdk
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
     * 获取jsapi_ticket
     * Create by Peter Yang
     * 2021-07-23 09:44:55
     * @param string $accessToken 全局access_token
     * @return string
     * @throws \Exception
     */
    public function getTicket(string $accessToken): string
    {

        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $accessToken . "&type=jsapi";


        $ticket = $this->http->get($url)->getBody()->getContents();

        $ticket = json_decode($ticket, true);


        if ($ticket['errcode'] !== 0) {

            throw new \Exception(json_encode($ticket));

        }

        return $ticket['ticket'];

    }

    /**
     * wxConfig配置生成
     * Create by Peter Yang
     * 2021-07-23 10:07:26
     * @param $jsapiTicket
     * @param $url
     * @return WxConfig
     * @throws \Exception
     */
    public function getWxConfig($jsapiTicket, $url): WxConfig
    {

        $param = [
            'noncestr' => Tool::nonceStr(),
            'jsapi_ticket' => $jsapiTicket,
            'timestamp' => time(),
            'url' => $url,
        ];


        ksort($param);

        $str = "";

        foreach ($param as $key => $value) {

            $str .= $key . "=" . $value . "&";

        }

        $str = substr($str, 0, -1);


        $str = sha1($str);

        $param['signature'] = $str;

        return new WxConfig($param['noncestr'], $param['jsapi_ticket'], $param['timestamp'], $param['url'],
            $param['signature']);


    }


}