<?php
namespace PhpHelper\NacosSdk\Provider;

use PhpHelper\NacosSdk\AbstractProvider;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class ConfigProvider extends AbstractProvider
{
    /**
     * 获取Nacos上的配置
     * @param string $dataId
     * @param string $group
     * @param string|null $tenant
     * @param array $options
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $dataId, string $group, string $tenant = null,array $options = []):ResponseInterface
    {
        $queryOptions = [
            'dataId'      => $dataId,
            'group'       => $group,
            'tenant'      => $tenant,
            'pageNo'      => isset($options['page'])?$options['page']:1,
            'pageSize'    => isset($options['pageSize'])?$options['pageSize']:10,
            'search'      => 'accurate',
            'appName'     => isset($options['appName'])?$options['appName']:null,
            'config_tags' => isset($options['appName'])?$options['appName']:null,
        ];

        return $this->request('GET','/nacos/v1/cs/configs',[
            RequestOptions::QUERY => $this->filter($queryOptions),
        ]);
    }

    /**
     * 发布 Nacos 上的配置
     * @param string $dataId
     * @param string $group
     * @param string $content
     * @param string|null $type
     * @param string|null $tenant
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function set(string $dataId, string $group, string $content, ?string $type = null, ?string $tenant = null): ResponseInterface
    {
        return $this->request('POST', '/nacos/v1/cs/configs', [
            RequestOptions::FORM_PARAMS => $this->filter([
                'dataId'  => $dataId,
                'group'   => $group,
                'tenant'  => $tenant,
                'type'    => $type,
                'content' => $content,
            ]),
        ]);
    }

    /**
     * 删除 Nacos 上的配置
     * @param string $dataId
     * @param string $group
     * @param string|null $tenant
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $dataId, string $group, ?string $tenant = null):ResponseInterface
    {
        return $this->getClient()->request('DELETE','/nacos/v1/cs/configs',[
            RequestOptions::QUERY => $this->filter([
                'dataId'  => $dataId,
                'group'   => $group,
                'tenant'  => $tenant,
            ])
        ]);
    }
}