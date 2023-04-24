<?php

namespace App\HttpClient;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FruitsApiHttpClient
{
    public const URL = 'https://fruityvice.com/api/fruit/all';

    private HttpClientInterface $client;


    public function __construct(HttpClientInterface $client, public LoggerInterface $logger)
    {
        $this->client = $client;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function fetchAllFruits(): array
    {
        $response = $this->client->request(
            'GET',
            self::URL,
            [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]
        );

        return $response->toArray();
    }
}
