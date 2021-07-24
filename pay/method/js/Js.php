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

//        $signature = Tool::signatureForPay($data, $this->payConfig->getPayKey());
//
//        $data['sign'] = $signature;


        $r=$this->http->post($url,[
            'json'=>$data,
            'headers'=>[
                'User-Agent'=>'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2105170 MicroMessenger/7.0.4 Language/zh_CN webview/16270895711527044 webdebugger port/21341 token/f56997a187bd90f191d90ae5d2bd4423',
                'Accept'=>'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'
            ]
        ]);


        return $r;



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