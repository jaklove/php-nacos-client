<?php
namespace PhpHelper\NacosSdk\Provider;


use PhpHelper\NacosSdk\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

trait AccessToken
{
    /**
     * @var null|string
     */
    private $accessToken;

    /**
     * @var int
     */
    private $expireTime = 0;

    /**
     * @return string
     */
    public function getAccessToken():?string
    {
        $username = $this->config->getUsername();
        $password = $this->config->getPassword();
        if ($username === null || $password === null) {
            return null;
        }

        if(!$this->isExpired()){
            return $this->accessToken;
        }

        /** @var $auth AuthProvider */
        $auth = $this->application->auth;
        $authResponse = $auth->login($username,$password);
        if(!$authResponse instanceof ResponseInterface){
            throw new RequestException("authResponse is not instanceof ResponseInterface");
        }

        $result = $this->handleResponse($authResponse);
        if(empty($result)){
            throw new RequestException("authResponse is empty");
        }

        $this->accessToken = $result['accessToken'];
        $this->expireTime = $result['tokenTtl'] + time();
        return $this->accessToken;
    }

    /**
     * @return bool
     */
    protected function isExpired(): bool
    {
        if (isset($this->accessToken) && $this->expireTime > time() + 60) {
            return false;
        }
        return true;
    }

}