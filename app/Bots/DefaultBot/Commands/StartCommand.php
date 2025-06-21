<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected $name = 'start:command';
    protected $description = 'Descripción del comando StartCommand';

    public function handle()
    {
        // Lógica del comando
    }
}