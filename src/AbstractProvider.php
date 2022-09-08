<?php
namespace PhpHelper\NacosSdk;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PhpHelper\NacosSdk\Exception\RequestException;
use PhpHelper\NacosSdk\Provider\AccessToken;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractProvider
{
    use AccessToken;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Application
     */
    protected $application;

    /**
     * AbstractProvider constructor.
     * @param Application $application
     * @param Config $config
     */
    public function __construct(Application $application,Config $config)
    {
        $this->application = $application;
        $this->config = $config;
    }

    /**
     * @return Client
     */
    public function getClient():Client
    {
        $config = array_merge($this->config->getGuzzleConfig(), [
            'base_uri' => $this->config->getHost()
        ]);

        return new Client($config);
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    protected function handleResponse(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        $contents = (string) $response->getBody();
        if ($statusCode !== 200) {
            throw new RequestException($contents, $statusCode);
        }
        return json_decode($contents,true);
    }

    /**
     * @param $method
     * @param $uri
     * @param array $options
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $uri, array $options = [])
    {
        $token = $this->getAccessToken();
        if(empty($token)){
            throw new \PhpHelper\NacosSdk\Exception\InvalidArgumentException("token is empty");
        }
        if($token){
            $options[RequestOptions::QUERY]['accessToken'] = $token;
        }
        return $this->getClient()->request($method, $uri, $options);
    }

    /**
     * @param array $input
     * @return array
     */
    protected function filter(array $input): array
    {
        $result = [];
        foreach ($input as $key => $value) {
            if ($value !== null) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}