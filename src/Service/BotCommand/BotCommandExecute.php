<?php

namespace App\Service\BotCommand;

class BotCommandExecute
{
    /**
     * @var BotCommandExchangeRate
     */
    private $botCommandExchangeRate;

    /**
     * @var BotDefaultCommand
     */
    private $botDefaultCommand;

    /**
     * @var BotStartCommand
     */
    private $botStartCommand;

    /**
     * BotCommandExecute constructor.
     * @param BotCommandExchangeRate $botCommandExchangeRate
     * @param BotDefaultCommand $botDefaultCommand
     * @param BotStartCommand $botStartCommand
     */
    public function __construct(
        BotCommandExchangeRate $botCommandExchangeRate,
        BotDefaultCommand $botDefaultCommand,
        BotStartCommand $botStartCommand)
    {
        $this->botCommandExchangeRate = $botCommandExchangeRate;
        $this->botDefaultCommand = $botDefaultCommand;
        $this->botStartCommand = $botStartCommand;
    }

    /**
     * @param $commandUser
     * @return string
     */
    public function response($commandUser)
    {
        $botCommandRegistry = new BotCommandRegistry();
        $botCommandRegistry->add($this->botDefaultCommand, BotCommand::DEFAULT_COMMAND);
        $botCommandRegistry->add($this->botStartCommand, BotCommand::START_COMMAND);
        $botCommandRegistry->add($this->botCommandExchangeRate, BotCommand::COURSE_COMMAND);

        return $botCommandRegistry->get($commandUser)->execute();
    }
}