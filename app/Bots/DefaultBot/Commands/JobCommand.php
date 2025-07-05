<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class JobCommand extends Command
{
    protected string $name = 'job';
    protected string $description = 'Descripción del comando Job';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => '¡Hola! Este es un mensaje de prueba del comando /job',
        ]);
    }
}