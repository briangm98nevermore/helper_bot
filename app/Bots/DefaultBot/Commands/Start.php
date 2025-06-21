<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class Start extends Command
{
    protected $signature = 'start';
    protected $description = 'Descripción del comando Start';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => '¡Hola! Este es un mensaje de prueba del comando /start',
        ]);
    }
}
