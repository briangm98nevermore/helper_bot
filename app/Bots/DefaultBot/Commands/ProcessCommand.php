<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class ProcessCommand extends Command
{
    protected string $name = 'process';
    protected string $description = 'Descripción del comando Process';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => '¡Hola! Este es un mensaje de prueba del comando /process',
        ]);
    }
}