<?php


namespace App\services;


use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AfpaConnectService
{
    private $client;
    private $param;
    private $cache;
    public function __construct(HttpClientInterface $client, ContainerBagInterface $param)
    {
        $this->param = $param;
        $this->client = $client;
        $this->cache = new FilesystemAdapter();
    }

    private function getToken(){
        try {
            $response = $this->client->request(
                'POST',
                $this->param->get('URL_API_AFPACONNECT') . 'auth',
                [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ],
                    'body' => [
                        "issuer" => 'afpasla',
                        "public_key" => file_get_contents($this->param->get('KEY_API_AFPACONNECT'))
                    ],
                ]
            );
        } catch (TransportExceptionInterface $e) {
            return false;
        }
        try {

            $auth_token = $this->cache->getItem('auth_token');
            $auth_token->set($response->getContent());
            $auth_token->expiresAfter(600);
            $this->cache->save($auth_token);
            return true;
        } catch (ClientExceptionInterface | TransportExceptionInterface | ServerExceptionInterface | RedirectionExceptionInterface $e) {
            return false;
        }
    }

    public function getUsers()
    {
        if (!$this->cache->getItem('auth_token')->get('value')) {
            $this->getToken();
        }

        try {
            $response = $this->client->request(
                'GET',
                $this->param->get('URL_API_AFPACONNECT') . 'users',
                [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ],
                    'query' => [
                        'issuer' => 'afpasla',
                    ],
                    'auth_bearer' => json_decode($this->cache->getItem('auth_token')->get('value'))
                ]
            );
        } catch (InvalidArgumentException | TransportExceptionInterface $e) {
            return false;
        }

        return json_decode($response->getContent(), true);
    }
}
