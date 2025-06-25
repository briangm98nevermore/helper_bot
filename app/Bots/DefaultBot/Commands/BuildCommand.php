<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class BuildCommand extends Command
{
    protected string $name = 'build';
    protected string $description = 'Descripción del comando BuildCommand';

    public function handle()
    {
        // Lógica del comando
        
        $this->replyWithMessage([
        'text' => '¡Hola! Este es un mensaje de prueba del comando /build',]);
    }
}
