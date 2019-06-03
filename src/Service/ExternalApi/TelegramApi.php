<?php

namespace App\Service\ExternalApi;

use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use HttpRequestException;

class TelegramApi
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
        $this->url = $_SERVER['api_telegram_url'] ?? '';
        $this->httpClient = $curlHttpClient;
        $this->loger = $logger;
    }

    /**
     * @param int $chatId
     * @param string $messageText
     * @return bool
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function sendMessage(int $chatId, string $messageText): bool
    {
        try {
            $response = $this->httpClient->request('GET', $this->url . '/sendMessage', [
                'query' => [
                    'chat_id' => $chatId,
                    'text' => $messageText,
                ]
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new HttpRequestException('Message not sent!');
            }

        } catch (Exception $e) {
            $this->loger->error($e->getMessage());
        }

        return true;
    }
}