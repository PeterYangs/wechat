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
     * 商品描述
     * @var string
     */
    protected $description;

    /**
     * 订单号
     * @var string
     */
    protected $outTradeNo;


    /**
     * 订单金额
     * @var integer
     */
    protected $total;




    /**
     * @var string 通知回调地址
     */
    protected $notify_url;


    /**
     *
     * @var string
     */
    protected $openId;


    /**
     * 附加属性
     * @var string
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
     * @param string $description
     * @param string $outTradeNo
     * @param int $total
     * @param string $notify_url
     * @param string $openId
     * @param string $attach
     */
    public function __construct(
        string $description,
        string $outTradeNo,
        int $total,

        string $notify_url,
        string $openId,
        string $attach = ''
    ) {
        $this->description = $description;
        $this->outTradeNo = $outTradeNo;
        $this->total = $total;
        $this->notify_url = $notify_url;
        $this->openId = $openId;
        $this->attach = $attach;

        $this->http = new Client();
    }


    function unifiedorder()
    {
        // TODO: Implement unifiedorder() method.


        $url = "https://api.mch.weixin.qq.com/v3/pay/transactions/jsapi";


        $data = [
            'appid' => $this->config->getAppId(),
            'mchid' => $this->payConfig->getMchId(),
            'description'=>$this->description,//商品描述
            'out_trade_no'=>$this->outTradeNo,//订单号
            'attach'=>$this->attach,
            'notify_url'=>$this->notify_url,
            'amount'=>[
                'total'=>$this->total,
            ],
            'payer'=>[
                'openid'=>$this->openId
            ],

        ];

        $signature = Tool::signatureForPay($data, $this->payConfig->getPayKey());

        $data['sign'] = $signature;

        //转xml格式
//        $data = Tool::arrayToXml($data);

        $r=$this->http->post($url,$data);

        $r->

        $re = $this->postXmlCurl($data, $url);


        $arr = $this->xmlToArray($re);

        if ($arr['return_code'] != "SUCCESS" || $arr['result_code'] != "SUCCESS") {


//            return json_encode([]);
            throw new \Exception(json_encode($arr));


        }


        return $arr;


    }

    function SetConfig(Config $config)
    {
        // TODO: Implement SetConfig() method.

        $this->config = $config;
    }

    function SetPayConfig(PayConfig $payConfig)
    {
        // TODO: Implement SetPayConfig() method.

        $this->payConfig = $payConfig;
    }
}