<?php

namespace App\Bots\DefaultBot\Commands;

use Telegram\Bot\Commands\Command;

class ListCommand extends Command
{
    protected string $name = 'list';
    protected string $description = 'Descripción del comando ListCommand';

    public function handle()
    {
        // Lógica del comando
    }
}