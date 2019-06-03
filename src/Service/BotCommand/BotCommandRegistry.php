<?php

namespace App\Service\BotCommand;

class BotCommandRegistry
{
    /**
     * @var array
     */
    private $registry = [];

    /**
     * @param BotCommand $command
     * @param string $nameCommand
     */
    public function add(BotCommand $command, string $nameCommand): void
    {
        $this->registry[$nameCommand] = $command;
    }

    /**
     * @param string $nameCommand
     * @return mixed
     */
    public function get(string $nameCommand): BotCommand
    {
        $command = $this->registry[BotCommand::DEFAULT_COMMAND];

        if (!empty($this->registry[$nameCommand])) {
            $command = $this->registry[$nameCommand];
        }

        return $command;
    }
}