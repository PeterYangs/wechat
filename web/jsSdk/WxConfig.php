<?php


namespace Web\jsSdk;


class WxConfig
{

    protected $nonceStr;

    protected $jsapiTicket;

    protected $timestamp;

    protected $url;

    protected $signature;

    /**
     * WxConfig constructor.
     * @param $nonceStr
     * @param $jsapiTicket
     * @param $timestamp
     * @param $url
     * @param $signature
     */
    public function __construct($nonceStr, $jsapiTicket, $timestamp, $url, $signature)
    {
        $this->nonceStr = $nonceStr;
        $this->jsapiTicket = $jsapiTicket;
        $this->timestamp = $timestamp;
        $this->url = $url;
        $this->signature = $signature;
    }

    /**
     * @return mixed
     */
    public function getNonceStr()
    {
        return $this->nonceStr;
    }

    /**
     * @return mixed
     */
    public function getJsapiTicket()
    {
        return $this->jsapiTicket;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Create by Peter Yang
     * 2021-07-23 10:21:56
     * @return array
     */
    public function toArray():array
    {

        return [
            'noncestr' => $this->nonceStr,
            'jsapi_ticket' => $this->jsapiTicket,
            'timestamp' => $this->timestamp,
            'url' => $this->url,
            'signature' => $this->signature,
        ];

    }


    /**
     * Create by Peter Yang
     * 2021-07-23 10:22:37
     * @return false|string
     */
    public function toJson():string
    {

        return json_encode([
            'noncestr' => $this->nonceStr,
            'jsapi_ticket' => $this->jsapiTicket,
            'timestamp' => $this->timestamp,
            'url' => $this->url,
            'signature' => $this->signature,
        ]);

    }


}