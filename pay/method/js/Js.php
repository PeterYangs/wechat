<?php


namespace Pay\method\js;


use Config\Config;
use GuzzleHttp\Client;
use Pay\config\PayConfig;
use Pay\contracts\PayInterface;
use Tool\Tool;


/**
 * 公众号和小程序支付
 * Class Js
 * @package Pay\method\js
 */
class Js implements PayInterface
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
     * @var Config
     */
    protected $config;


    /**
     * @var PayConfig
     */
    protected $payConfig;


    /**
     * @var Client
     */
    protected $http;


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
        $this->http = new Client();
    }


    /**
     * 统一
     * Create by Peter Yang
     * 2021-07-24 11:29:29
     * @return mixed
     * @throws \Exception
     */
    function unifiedorder()
    {
        // TODO: Implement unifiedorder() method.


        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";


        $data = [
            'appid' => $this->config->getAppId(),
            'mch_id' => $this->payConfig->getMchId(),
            'nonce_str' => Tool::nonceStr(),
            'body' => $this->body, //商品描述
            'out_trade_no' => $this->outTradeNo,
            'total_fee' => $this->totalFee,
            'spbill_create_ip' => $this->ip,
            'notify_url' => $this->notifyUrl,
            'trade_type' => 'JSAPI',
            'openid' => $this->openid,
            'attach' => $this->attach
        ];

        $signature = Tool::signatureForPay($data, $this->payConfig->getPayKey());

        $data['sign'] = $signature;

        //转xml格式
        $data = Tool::arrayToXml($data);

        $re = Tool::requestForPay($data, $url);


        $arr = Tool::xmlToArray($re);

        if ($arr['return_code'] !== "SUCCESS" || $arr['result_code'] !== "SUCCESS") {

            throw new \Exception(json_encode($arr));

        }


        return $arr;

    }

    public function SetConfig(Config $config): void
    {
        // TODO: Implement SetConfig() method.

        $this->config = $config;
    }

    public function SetPayConfig(PayConfig $payConfig): void
    {
        // TODO: Implement SetPayConfig() method.

        $this->payConfig = $payConfig;
    }
}