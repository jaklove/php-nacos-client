# Nacos PHP SDK


## 安装下面composer包

```shell
composer require zhourenjie/php-nacos-client
```
```php
<?php

use PhpHelper\NacosSdk\Application;
use PhpHelper\NacosSdk\Config;

$application = new Application(new Config([
    'username' => 'nacos',
    'password' => 'nacos',
    'guzzle_config' => [
        'headers' => [
            'charset' => 'UTF-8',
        ],
    ],
]));

$response = $application->auth->login('nacos', 'nacos');
$result = json_decode($response->getBody(),true);

$response = $application->config->get('hyperf-service-config', 'DEFAULT_GROUP');
$result = json_decode($response->getBody(),true);

//具体请看nacos官网 open api设计
@link(https://nacos.io/zh-cn/docs/open-api.html)
```
