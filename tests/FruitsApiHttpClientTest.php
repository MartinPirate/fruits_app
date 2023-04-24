<?php

namespace App\Tests;

use App\HttpClient\FruitsApiHttpClient;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class FruitsApiHttpClientTest extends TestCase
{

    private $httpClient;
    private $response;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testFetchAllFruits(): void
    {
        $fruits = [
            [
                "name" => "Persimmon",
                "family" => "Ebenaceae",
                "order" => "Rosales",
                "genus" => "Diospyros",
                "nutritions" => [
                    "carbohydrate" => 12.5,
                    "protein" => 0.9,
                    "fat" => 0.2,
                    "calories" => 54
                ]
            ]
        ];

        $this->response->expects($this->once())
            ->method('toArray')
            ->willReturn($fruits);

        $this->httpClient->expects($this->once())
            ->method('request')
            ->with('GET', FruitsApiHttpClient::URL, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ])
            ->willReturn($this->response);

        $logger = new NullLogger();
        $client = new FruitsApiHttpClient($this->httpClient, $logger);

        $result = $client->fetchAllFruits();

        $this->assertEquals($fruits, $result);


    }
}