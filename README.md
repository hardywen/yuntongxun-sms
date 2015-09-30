#云通讯 短信Api
有个云通讯 和 云之讯 的接口几乎一样的。所以拿云之讯的改改

#安装 
在composer.json 添加 
```json
hardywen/yuntongxun-sms: 'v1.0'
```

运行 ```composer update```

在 ```config/app.php```的providers数组里加入
```php
Hardywen\YuntongxunSms\YuntongxunSmsServiceProvider::class,
```
aliases 数组里加入
```php
'YuntongxunSms' => Hardywen\YuntongxunSms\Facade\YuntongxunSms::class,
```

运行
```php 
php artisan vendor:publish
```

去 ```config/yuntongxun.php``` 配置

#使用
发送手机短信
```php
YuntongxunSms::templateSMS('9635', '123456,3', '138xxxxxx')
```

发送语音验证码
```php
YuntongxunSms::voiceCode('123123','138xxxx')
```
