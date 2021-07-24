<?php


namespace Pay\method\js;


class JsUnifiedOrder implements \Pay\contracts\UnifiedOrder
{


    /**
     *
     * @var string 商品描述
     */
    protected $body;


    /**
     * @var string 订单号
     */
    protected $outTradeNo;
    /**
     * @var int 订单金额，单位分
     */
    protected $totalFee;
    /**
     * @var string 客户端ip
     */
    protected $ip;
    /**
     * @var string 通知地址
     */
    protected $notifyUrl;
    /**
     * @var string
     */
    protected $openid;
    /**
     * @var string 附加属性
     */
    protected $attach;

    /**
     * Js constructor.
     * @param string $body
     * @param string $outTradeNo
     * @param int $totalFee
     * @param string $ip
     * @param string $notifyUrl
     * @param string $openid
     * @param string $attach
     */
    public function __construct(
        string $body,
        string $outTradeNo,
        int $totalFee,
        string $ip,
        string $notifyUrl,
        string $openid,
        string $attach
    ) {
        $this->body = $body;
        $this->outTradeNo = $outTradeNo;
        $this->totalFee = $totalFee;
        $this->ip = $ip;
        $this->notifyUrl = $notifyUrl;
        $this->openid = $openid;
        $this->attach = $attach;

    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getOutTradeNo(): string
    {
        return $this->outTradeNo;
    }

    /**
     * @return int
     */
    public function getTotalFee(): int
    {
        return $this->totalFee;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): string
    {
        return $this->notifyUrl;
    }

    /**
     * @return string
     */
    public function getOpenid(): string
    {
        return $this->openid;
    }

    /**
     * @return string
     */
    public function getAttach(): string
    {
        return $this->attach;
    }


}