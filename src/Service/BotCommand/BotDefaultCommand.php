<?php

namespace App\Service\BotCommand;

class BotDefaultCommand implements BotCommand
{
    /**
     * @return string
     */
    public function execute(): string
    {
        return 'Бот не знает данной команды!';
    }
}