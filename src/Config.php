<?php
namespace PhpHelper\NacosSdk;


class Config
{
    /**
     * @var array
     */
    protected $guzzleConfig = [
        'headers' => [
            'charset' => 'UTF-8',
        ],
    ];

    /**
     * @var string
     */
    protected $host = 'http://127.0.0.1:8848';

    /**
     * 用户名
     * @var string
     */
    protected $username = '';

    /**
     * 用户名
     * @var string
     */
    protected $password = '';

    /**
     * nacos配置
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if(isset($config['host'])){
            $this->host = (string) $config['host'];
        }
        if(isset($config['username'])){
            $this->username = (string)$config['username'];
        }
        if(isset($config['password'])){
            $this->password = (string)$config['password'];
        }
        if(isset($config['guzzle_config'])){
            $this->guzzleConfig = (array) $config['guzzle_config'];
        }
    }

    /**
     * @desc 获取host
     * @return string
     */
    public function getHost():string
    {
        return $this->host;
    }

    /**
     * @desc 获取用户名
     * @return string
     */
    public function getUsername():string
    {
        return $this->username;
    }

    /**
     * @desc 获取密码
     * @return string
     */
    public function getPassword():string
    {
        return $this->password;
    }

    /**
     * @desc 获取guzzle配置
     * @return array|\string[][]
     */
    public function getGuzzleConfig(): array
    {
        return $this->guzzleConfig;
    }
}