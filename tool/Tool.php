<?php

namespace Tool;

class Tool
{


    /**
     * 生成随机字符串
     * Create by Peter
     * @param int $length
     * @return string
     * @throws \Exception
     */
    public static function nonceStr(int $length = 16)
    {

        $str = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";

        $nonceStr = "";

        for ($i = 0; $i < $length; $i++) {


            $nonceStr .= $str[random_int(0, strlen($str) - 1)];

        }


        return $nonceStr;

    }


    /**
     * 微信支付获取签名
     * Create by Peter
     * @param array $param
     * @param string $payKey
     * @return string
     */
    public static function signatureForPay(array $param, string $payKey): string
    {

        ksort($param);

        $str = "";

        foreach ($param as $key => $value) {

            $str .= $key . "=" . $value . "&";

        }

        $str = substr($str, 0, -1);


        $str .= "&key=" . $payKey;

        return md5($str);

    }


    /**
     * 数组转XML
     * Create by Peter
     * @param $arr
     * @return string
     */
    public static function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    /**
     * xml转数组
     * Create by Peter
     * @param $xml
     * @return mixed
     */
    public static function xmlToArray($xml)
    {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $values;
    }


    /**
     * 接口请求
     * Create by Peter
     * 2019/12/30 08:56:14
     * Email:904801074@qq.com
     * @param $xml
     * @param $url
     * @param int $second
     * @param string $cert_path
     * @param string $key_path
     * @return bool|string
     * @throws \Exception
     */
    public static function requestForPay($xml, $url, int $second = 30, string $cert_path = "", string $key_path = "")
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, false);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($cert_path && $key_path) {
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch, CURLOPT_SSLCERT, $cert_path);
            curl_setopt($ch, CURLOPT_SSLKEY, $key_path);
        }
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_error($ch);
            curl_close($ch);

            throw new \Exception($error);

        }
    }


    /**
     * Create by Peter Yang
     * 2021-07-24 16:16:00
     * @return string
     */
    public static function returnSuccess():string
    {


        return "<xml>
                <return_code><![CDATA[SUCCESS]]></return_code>
                <return_msg><![CDATA[OK]]></return_msg>
             </xml>";
    }


}