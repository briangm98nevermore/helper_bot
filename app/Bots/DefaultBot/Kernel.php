<?php

namespace App\Bots\DefaultBot;

use Telegram\Bot\Api;

class Kernel
{
    public static function register(Api $bot): void
    {
        $bot->addCommands([
            \App\Bots\DefaultBot\Commands\StartCommand::class,
        ]);
    }
}
