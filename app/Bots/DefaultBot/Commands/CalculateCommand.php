<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class CalculateCommand extends Command
{
    protected string $name = 'calculate';
    protected string $description = 'Descripción del comando Calculate';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => '¡Hola! Este es un mensaje de prueba del comando /calculate',
        ]);
    }
}