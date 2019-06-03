<?php

namespace App\Service\BotCommand;

interface BotCommand
{
    const DEFAULT_COMMAND = 'default';

    const START_COMMAND = 'start';

    const COURSE_COMMAND = 'course';

    public function execute(): string;
}