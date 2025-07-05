<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class EnterCommand extends Command
{
    protected string $name = 'enter';
    protected string $description = 'Descripción del comando Enter';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => '¡Hola! Este es un mensaje de prueba del comando /enter',
        ]);
    }
}