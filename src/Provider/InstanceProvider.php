<?php
namespace PhpHelper\NacosSdk\Provider;

use GuzzleHttp\RequestOptions;
use PhpHelper\NacosSdk\AbstractProvider;
use Psr\Http\Message\ResponseInterface;

class InstanceProvider extends AbstractProvider
{
    /**
     * @desc 注册一个实例到服务
     * @param $options = [
     *     'groupName' => '',
     *     'clusterName' => '', //集群名
     *     'namespaceId' => '', //命名空间ID
     *     'weight' => 99.0,
     *     'metadata' => '',
     *     'enabled' => true,
     *     'ephemeral' => false, // 是否临时实例
     * ]
     */
    public function register(string $ip, int $port, string $serviceName,array $options = []):ResponseInterface
    {
        return $this->request('POST','/nacos/v1/ns/instance',[
            RequestOptions::QUERY => $this->filter(array_merge($options,[
                'ip'  => $ip,
                'port' => $port,
                'serviceName' => $serviceName
            ]))
        ]);
    }

    /**
     * @desc 注册一个实例到服务
     * @param $options = [
     *     'groupName' => '',
     *     'clusterName' => '', //集群名
     *     'namespaceId' => '', //命名空间ID
     *     'enabled' => true,
     *     'ephemeral' => false, // 是否临时实例
     * ]
     */
    public function delete(string $ip, int $port, string $serviceName,array $options = []):ResponseInterface
    {
        return $this->request('DELETE','/nacos/v1/ns/instance',[
            RequestOptions::QUERY => $this->filter(array_merge($options,[
                'ip'   => $ip,
                'port' => $port,
                'serviceName' => $serviceName
            ]))
        ]);
    }

    /**
     * @param string $ip
     * @param int $port
     * @param string $serviceName
     * @param array $options = [
     *     'groupName' => '',
     *     'clusterName' => '', //集群名
     *     'namespaceId' => '', //命名空间ID
     *     'weight' => 99.0,
     *     'metadata' => '',
     *     'enabled' => true,
     *     'ephemeral' => false, // 是否临时实例
     * ]
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(string $ip, int $port, string $serviceName,array $options = []):ResponseInterface
    {
        return $this->request('PUT', '/nacos/v1/ns/instance', [
            RequestOptions::QUERY => $this->filter(array_merge($options, [
                'serviceName' => $serviceName,
                'ip' => $ip,
                'port' => $port,
            ])),
        ]);
    }

    /**
     * @param string $serviceName
     * @param array  $options = [
     *     'groupName' => '',  // 服务名
     *     'groupName' => '', //分组名
     *     'namespaceId' => '', //命名空间ID
     *     'clusters' => '', // 集群名称
     *     'healthyOnly' => false, // 是否只返回健康实例
     * ]
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getServiceInstanceList(string $serviceName,array $options = []):ResponseInterface
    {
        return $this->request('GET','/nacos/v1/ns/instance/list',$this->filter(array_merge($options,[
            RequestOptions::QUERY => [
                'serviceName' => $serviceName
            ]
        ])));
    }

    /**
     * @param string $ip
     * @param int $port
     * @param string $serviceName
     * @param array $options = [
     *     'groupName' => '',  // 服务名
     *     'groupName' => '', //分组名
     *     'namespaceId' => '', //命名空间ID
     *     'clusters' => '', // 集群名称
     *     'healthyOnly' => false, // 是否只返回健康实例
     * ]
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getServiceInstance(string $ip, int $port, string $serviceName,array $options = []):ResponseInterface
    {
        return $this->request('GET','/nacos/v1/ns/instance',[
            RequestOptions::QUERY => $this->filter(array_merge($options,[
                'serviceName' => $serviceName,
                'ip' => $ip,
                'port' => $port,
            ]))
        ]);
    }

    /**
     * @param string $ip
     * @param int $port
     * @param string $serviceName
     * @param string $beat
     * @param array $options = [
     *     'groupName' => '', //分组名
     *     'namespaceId' => '', //命名空间ID
     *     'ephemeral' => false, // 是否临时实例
     * ]
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function beat(string $ip, int $port, string $serviceName,string $beat,array $options = []):ResponseInterface
    {
        return $this->request('PUT','/nacos/v1/ns/instance/beat',[
            RequestOptions::QUERY => $this->filter(array_merge($options,[
                'serviceName' => $serviceName,
                'ip' => $ip,
                'port' => $port,
                'beat' => $beat
            ]))
        ]);
    }

    /**
     *
     * @description 更新实例的健康状态,仅在集群的健康检查关闭时才生效,当集群配置了健康检查时,该接口会返回错误
     * @param string $ip
     * @param int $port
     * @param string $serviceName
     * @param bool $health
     * @param array $options
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function healthy(string $ip, int $port, string $serviceName,bool $health,array $options = []):ResponseInterface
    {
        return $this->request('PUT', '/nacos/v1/ns/health/instance', [
            RequestOptions::QUERY => $this->filter(array_merge($options, [
                'serviceName' => $serviceName,
                'ip' => $ip,
                'port' => $port,
                'healthy' => $health
            ])),
        ]);
    }
}