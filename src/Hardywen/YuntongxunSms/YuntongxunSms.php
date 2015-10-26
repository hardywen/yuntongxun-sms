<?php

namespace Hardywen\YuntongxunSms;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class YuntongxunSms
{

    use HelperTrait;

    /**
     * 接口配置，可以通过setConfig方法来覆盖默认配置（默认配置来自配置文件）
     * @var array
     */
    public $config = [];

    /**
     * 时间字符串，格式为 yyyyMMddHHmmss
     * @var string
     */
    public $time;

    function __construct($config = null)
    {
        $this->time = Carbon::now()->format('YmdHis');

        $this->config = Config::get('yuntongxun');
    }

    /**
     * 如果有必要可以使用此方法来覆盖默认配置
     * @param $config array
     */
    public function setConfig($config)
    {
        $this->config = array($this->config, $config);
    }

    /**
     * 短信验证码（模板短信）
     * @param $templateId
     * @param $param
     * @param $to
     * @return mixed
     */
    public function templateSMS($templateId, $param, $to)
    {
        $data = [
            'appId' => $this->config['appId'],
            'datas' => $param,
            'templateId' => $templateId,
            'to' => $to
        ];

        return $this->responsePost('SMS/TemplateSMS', $data);
    }

    /**
     * 语音验证码
     * @param $verifyCode
     * @param $to
     * @param null $displayNum
     * @return mixed
     */
    public function voiceCode($verifyCode, $to, $displayNum = null)
    {
        $data = [
            'appId' => $this->config['appId'],
            'verifyCode' => $verifyCode,
            'displayNum' => $displayNum,
            'to' => $to
        ];

        return $this->responsePost('Calls/VoiceVerify', $data);

    }

    /**
     * 获取流量档位
     * @param $phoneNum
     * @return mixed
     */
    public function flowPackage($phoneNum)
    {
        $data = [
            'phoneNum' => $phoneNum
        ];

        return $this->responsePost('flowPackage/flowPackage', $data);

    }

    /**
     * 直充
     * @param $phoneNum
     * @param $sn 业务定制手机号
     * @param $packet 业务定制手机号
     * @param $customId 第三方交易id  长度不超过32为非中文、非特殊字符、要求唯一
     * @param $callbackUrl 回调第三方的地址
     * @param string $reason 第三方扩展参数
     * @return mixed
     */
    public function flowRecharge($phoneNum, $sn, $packet, $customId, $callbackUrl, $reason = '')
    {
        $data = [
            'appId' => $this->config['appId'],
            'phoneNum' => $phoneNum,
            'sn' => $sn,
            'packet' => $packet,
            'reason' => $reason,
            'customId' => $customId,
            'callbackUrl' => $callbackUrl,
        ];

        return $this->responsePost('flowPackage/flowRecharge', $data);

    }

    /**
     * 流量充值状态查询
     * @param $rechargeId
     * @param null $customId
     * @return mixed
     */
    public function flowRechargeStatus($rechargeId, $customId = null)
    {
        $data = [
            'appId' => $this->config['appId'],
            'rechargeId' => $rechargeId,
            'customId' => $customId,
        ];

        return $this->responsePost('flowPackage/flowRechargeStatus', $data);

    }
}