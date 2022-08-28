<?php
namespace PhpHelper\NacosSdk;


use PhpHelper\NacosSdk\Exception\InvalidArgumentException;
use PhpHelper\NacosSdk\Provider\AuthProvider;
use PhpHelper\NacosSdk\Provider\ConfigProvider;
use PhpHelper\NacosSdk\Provider\InstanceProvider;
use PhpHelper\NacosSdk\Provider\OperatorProvider;
use PhpHelper\NacosSdk\Provider\ServiceProvider;

class Application
{
    /**
     * 服务实例
     * @var string[]
     */
    protected $alias = [
        'auth' => AuthProvider::class,
        'config' => ConfigProvider::class,
        'instance' => InstanceProvider::class,
        'operator' => OperatorProvider::class,
        'service' => ServiceProvider::class,
    ];


    /**
     *
     * @var array
     */
    protected $providers = [];

    /**
     * @var Config
     */
    protected $config;

    /**
     * 配置
     * Application constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name):AbstractProvider
    {
        if (! isset($name) || ! isset($this->alias[$name])) {
            throw new InvalidArgumentException("{$name} is invalid.");
        }

        if (isset($this->providers[$name])) {
            return $this->providers[$name];
        }

        $class = $this->alias[$name];
        return $this->providers[$name] = new $class($this, $this->config);
    }
}
