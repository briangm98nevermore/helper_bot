<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class HelpCommand extends Command
{
    protected string $name = 'help';
    protected string $description = 'Descripción del comando HelpCommand';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => '¡Hola! Este es un mensaje de prueba del comando /help',
        ]);
    }
}
