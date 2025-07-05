<?php

namespace App\Bots\DefaultBot;

class Kernel
{
    public static function commands(): array
    {
        return [
            \App\Bots\DefaultBot\Commands\StartCommand::class,
            \App\Bots\DefaultBot\Commands\HelpCommand::class,
            \App\Bots\DefaultBot\Commands\ListCommand::class,
            \App\Bots\DefaultBot\Commands\BuildCommand::class,
            \App\Bots\DefaultBot\Commands\CalculateCommand::class,
            \App\Bots\DefaultBot\Commands\ProcessCommand::class,
            \App\Bots\DefaultBot\Commands\EvaluatedCommand::class,
            \App\Bots\DefaultBot\Commands\JobCommand::class,
            \App\Bots\DefaultBot\Commands\EnterCommand::class
        ];
    }
}
