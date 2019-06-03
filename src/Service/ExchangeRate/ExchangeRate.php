<?php

namespace App\Service\ExchangeRate;

interface ExchangeRate
{
    /**
     * @return string
     */
    public function allExchangeRate(): string;
}