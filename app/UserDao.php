<?php


namespace App;


class UserDao
{

    /**
     * @var string
     */
    protected $openid;


    /**
     * @var string
     */
    protected $nickName;


    /**
     * @var
     */
    protected $gender;


    /**
     * @var
     */
    protected $language;

    /**
     * @var
     */
    protected $city;


    /**
     * @var
     */
    protected $province;

    /**
     * @var
     */
    protected $country;


    /**
     * @var string 头像
     */
    protected $avatarUrl;

    /**
     * @var string
     */
    protected $unionId;

    /**
     * @var string
     */
    protected $appid;

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->all;
    }


    /**
     * @var array
     */
    protected $all;

    /**
     * UserDao constructor.
     * @param string $openid
     * @param string $nickName
     * @param $gender
     * @param $language
     * @param $city
     * @param $province
     * @param $country
     * @param string $avatarUrl
     * @param string $unionId
     * @param string $appid
     * @param array $all
     */
    public function __construct(
        string $openid,
        string $nickName,
        $gender,
        $language,
        $city,
        $province,
        $country,
        string $avatarUrl,
        string $unionId,
        string $appid,
        array $all
    ) {
        $this->openid = $openid;
        $this->nickName = $nickName;
        $this->gender = $gender;
        $this->language = $language;
        $this->city = $city;
        $this->province = $province;
        $this->country = $country;
        $this->avatarUrl = $avatarUrl;
        $this->unionId = $unionId;
        $this->appid = $appid;
        $this->all = $all;
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
    public function getNickName(): string
    {
        return $this->nickName;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    /**
     * @return string
     */
    public function getUnionId(): string
    {
        return $this->unionId;
    }

    /**
     * @return string
     */
    public function getAppid(): string
    {
        return $this->appid;
    }

}