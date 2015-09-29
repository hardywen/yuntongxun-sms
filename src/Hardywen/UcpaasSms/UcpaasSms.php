<?php

namespace Hardywen\UcpaasSms;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class UcpaasSms
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

        $this->config = Config::get('ucpaas');
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
}