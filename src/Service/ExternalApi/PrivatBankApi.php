<?php
namespace App\Service\ExternalApi;

use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use DateTimeInterface;
use HttpRequestException;

class  PrivatBankApi
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var LoggerInterface
     */
    private $loger;

    /**
     * @var string
     */
    private $url;

    /**
     * TelegramApi constructor.
     * @param HttpClientInterface $curlHttpClient
     * @param LoggerInterface $logger
     */
    public function __construct(HttpClientInterface $curlHttpClient, LoggerInterface $logger)
    {
        $this->url = $_SERVER['api_privat_url'] ?? '';
        $this->httpClient = $curlHttpClient;
        $this->loger = $logger;
    }

    /**
     * @param DateTimeInterface $dateTime
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getExchangeRates(DateTimeInterface $dateTime): array
    {
        $result = [];

        try {
            $response = $this->httpClient->request('GET', $this->url . '/exchange_rates?json', [
                'query' => [
                    'date' => $dateTime->format('d.m.Y'),
                ]
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new HttpRequestException('Request failed!');
            }

            $result = $response->toArray();

        } catch (Exception $e) {
            $this->loger->error($e->getMessage());
        }

        return $result;
    }
}