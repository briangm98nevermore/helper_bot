<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected $signature = 'start:command';
    protected $description = 'Descripción del comando StartCommand';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => '¡Hola! Este es un mensaje de prueba del comando /start',
        ]);
    }
}
