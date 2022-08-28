<?php
namespace PhpHelper\NacosSdk\Provider;

use GuzzleHttp\RequestOptions;
use PhpHelper\NacosSdk\AbstractProvider;
use Psr\Http\Message\ResponseInterface;

class OperatorProvider extends AbstractProvider
{
    /**
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSwitches(): ResponseInterface
    {
        return $this->request('GET', '/nacos/v1/ns/operator/switches');
    }

    /**
     * @param string $entry
     * @param string $value
     * @param bool|null $debug
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateSwitches(string $entry, string $value, ?bool $debug = null): ResponseInterface
    {
        return $this->request('PUT', '/nacos/v1/ns/operator/switches', [
            RequestOptions::QUERY => $this->filter([
                'entry' => $entry,
                'value' => $value,
                'debug' => $debug,
            ]),
        ]);
    }

    /**
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMetrics(): ResponseInterface
    {
        return $this->request('GET', '/nacos/v1/ns/operator/metrics');
    }

    /**
     * @param bool|null $healthy
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getServers(?bool $healthy = null): ResponseInterface
    {
        return $this->request('GET', '/nacos/v1/ns/operator/servers', [
            RequestOptions::QUERY => $this->filter([
                'healthy' => $healthy,
            ]),
        ]);
    }

    public function getLeader(): ResponseInterface
    {
        return $this->request('GET', '/nacos/v1/ns/raft/leader');
    }
}