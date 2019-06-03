<?php

namespace App\Service\BotCommand;

use App\Service\ExchangeRate\ExchangeRate;

class BotCommandExchangeRate implements BotCommand
{
    /**
     * @var ExchangeRate
     */
    private $exchangeRate;

    /**
     * BotCommandExchangeRate constructor.
     * @param ExchangeRate $exchangeRate
     */
    public function __construct(ExchangeRate $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @return string
     */
    public function execute(): string
    {
        return $this->exchangeRate->allExchangeRate();
    }
}