<?php

namespace App\Bots\Console;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class PollingCommand extends Command
{
    protected $signature = 'bot:polling
                            {bot=default : Nombre del bot configurado en config/telegram.php}';

    protected $description = 'Ejecuta el long polling del bot de Telegram indicado';

    public function handle(): void
    {
        $inputKey = $this->argument('bot');

        // Si el usuario puso "default", usamos la clave real configurada
        $botKey = $inputKey === 'default'
            ? config('telegram.default')
            : $inputKey;

        $this->info("Iniciando polling para el bot: {$botKey}");

        try {
            while (true) {
                Telegram::bot($botKey)->commandsHandler();
                sleep(1); // pequeño delay para no saturar
            }
        } catch (\Exception $e) {
            $this->error("Error al iniciar el polling: " . $e->getMessage());
        }
    }
}
