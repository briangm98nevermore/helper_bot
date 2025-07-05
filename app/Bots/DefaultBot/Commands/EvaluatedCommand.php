<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class EvaluatedCommand extends Command
{
    protected string $name = 'evaluated';
    protected string $description = 'Descripción del comando Evaluated';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => '¡Hola! Este es un mensaje de prueba del comando /evaluated',
        ]);
    }
}