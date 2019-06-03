<?php

namespace App\Service\BotCommand;

class BotStartCommand implements BotCommand
{
    /**
     * @return string
     */
    public function execute(): string
    {
        return 'Добро пожаловать в бот курса валют!';
    }
}