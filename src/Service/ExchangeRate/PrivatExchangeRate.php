<?php

namespace App\Service\ExchangeRate;

use App\Service\ExternalApi\PrivatBankApi;
use DateTime;

class PrivatExchangeRate implements ExchangeRate
{
    /**
     * @var PrivatBankApi
     */
    private $privatBankApi;

    /**
     * PrivatExchangeRate constructor.
     * @param PrivatBankApi $privatBankApi
     */
    public function __construct(PrivatBankApi $privatBankApi)
    {
        $this->privatBankApi = $privatBankApi;
    }

    /**
     * @return string
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function allExchangeRate(): string
    {
        $result = '';
        $dateTimeNow = new DateTime();
        $exchangeRates = $this->privatBankApi->getExchangeRates($dateTimeNow);

        if (!empty($exchangeRates['exchangeRate'])) {
            $exchangeRates = $exchangeRates['exchangeRate'];
        }

        foreach ($exchangeRates as $exchangeRate) {
            if (!empty($exchangeRate['currency']) && !empty($exchangeRate['saleRateNB'])) {
                $result .= $exchangeRate['currency'] . ' - ' . $exchangeRate['saleRateNB'] . PHP_EOL;
            }
        }

        return $result;
    }
}