<?php namespace Hardywen\YuntongxunSms\Facade;

use Illuminate\Support\Facades\Facade;

class YuntongxunSms extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'yuntongxun-sms';
    }

}