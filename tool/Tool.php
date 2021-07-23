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
     * @return bool|string
     */
    public static function signatureForPay(array $param, string $payKey)
    {

        ksort($param);

        $str = "";

        foreach ($param as $key => $value) {

            $str .= $key . "=" . $value . "&";

        }

        $str = substr($str, 0, strlen($str) - 1);


        $str .= "&key=" . $payKey;

        $str = md5($str);

        return $str;

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


}