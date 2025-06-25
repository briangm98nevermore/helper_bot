<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class HelpCommand extends Command
{
    protected $name = 'help';
    protected $description = 'Descripción del comando HelpCommand';

    public function handle()
    {
        // Lógica del comando
    }
}