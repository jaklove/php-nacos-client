<?php

require './vendor/autoload.php';
use PhpHelper\NacosSdk\Application;
use PhpHelper\NacosSdk\Config;

//$beactStr = json_encode(['beat' => 'success']);
//echo $beactStr;
//die;
$application = new Application(new Config([
    'username' => 'nacos',
    'password' => 'nacos',
    'guzzle_config' => [
        'headers' => [
            'charset' => 'UTF-8',
        ],
    ],
]));


/**
 * @var $config \PhpHelper\NacosSdk\Provider\ConfigProvider
 */
//$config = $application->config;
//$res = $config->set('hyperf-service-config-1', 'DEFAULT_GROUP','xindai nacos config','test');
//$res = $config->delete('hyperf-service-config-1','DEFAULT_GROUP');
//$res = $config->get('hyperf-service-config-1','DEFAULT_GROUP');
//var_dump(json_decode($res->getBody(),true));die;


/**
 * @var $instance \PhpHelper\NacosSdk\Provider\InstanceProvider
 */
$instance = $application->instance;
//$instanceRes = $instance->register('127.0.0.1','6379','instance',['ephemeral' => false]);
//$instanceRes = $instance->register('127.0.0.1','6380','instance',['ephemeral' => false]);
//$instanceRes = $instance->update('127.0.0.1','6380','instance',[
//    'weight' => 0.99
//]);
//
//var_dump($instanceRes->getStatusCode());die;

//var_dump(json_decode($instanceRes->getBody(),true));die;

//$instanceRes = $instance->delete('127.0.0.1','6379','instance');
//$list = $instance->getServiceInstanceList('instance');
//var_dump(json_decode($list->getBody(),true)['hosts']);die;

//发送心跳
//$instance->beat('127.0.0.1','6380','instance','{"beat":"success"}');
//$instance->healthy('127.0.0.1','6380','instance',false);
//
////获取实例
//$instanceRes = $instance->getServiceInstance('127.0.0.1','6380','instance');
//
//
//
//var_dump(json_decode($instanceRes->getBody(),true));die;



//创建服务
/** @var  $service \PhpHelper\NacosSdk\Provider\ServiceProvider */
$service = $application->service;
//$serviceRes = $service->create('zhourenjie_sevice');
//$serviceRes =  $service->delete('zhourenjie sevice');
//$serviceRes = $service->get('zhourenjie sevice');
$serviceRes = $service->update('zhourenjie_sevice',['protectThreshold' => 0.11]);
$serviceRes = $service->list(1,100);

$serviceRes = $service->get('zhourenjie_sevice');

//$serviceRes = $service->get('zhourenjie sevice');

//获取服务

var_dump(json_decode($serviceRes->getBody(),true));



//var_dump($response);die;