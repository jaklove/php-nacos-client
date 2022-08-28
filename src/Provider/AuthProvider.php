<?php
namespace PhpHelper\NacosSdk\Provider;

use PhpHelper\NacosSdk\AbstractProvider;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\RequestOptions;

class AuthProvider extends AbstractProvider
{
    public function login(string $username,string $password):ResponseInterface
    {
       $requestClient = $this->getClient();
       return $requestClient->request("POST","/nacos/v1/auth/users/login",[
           RequestOptions::QUERY => [
               'username' => $username,
               'password' => $password,
           ],
       ]);
    }
}