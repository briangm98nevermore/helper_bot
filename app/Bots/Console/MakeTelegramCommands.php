<?php

namespace App\Bots\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeTelegramCommands extends Command
{
    protected $signature = 'app:telegram-command {name : Nombre del comando}';
    protected $description = 'Crea un nuevo comando de Telegram para un bot';

    public function handle(): void
    {
        $commandName = $this->argument('name'); // Ej: HelpCommand
        $shortName = str_replace('Command', '', $commandName); // Help
        $commandSlug = strtolower($shortName); // help

        $namespace = 'App\\Bots\\DefaultBot\\Commands';
        $directory = app_path('Bots/DefaultBot/Commands');
        $path = "{$directory}/{$commandName}.php";
        $class = "{$namespace}\\{$commandName}";

        if (File::exists($path)) {
            $this->error("El comando {$commandName} ya existe.");
            return;
        }

        // Creamos el directorio si no existe
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Generamos el contenido de la clase
        $classContent = <<<PHP
            <?php

            namespace {$namespace};

            use Telegram\Bot\Commands\Command;

            class {$commandName} extends Command
            {
                protected string \$name = '{$commandSlug}';
                protected string \$description = 'Descripción del comando {$shortName}';

                public function handle()
                {
                    \$this->replyWithMessage([
                        'text' => '¡Hola! Este es un mensaje de prueba del comando /{$commandSlug}',
                    ]);
                }
            }
            PHP;

        File::put($path, $classContent);
        $this->info("Comando creado en: {$path}");

        $this->registerInTelegramConfig($class);
    }

    protected function registerInTelegramConfig(string $commandClass): void
    {
        $configPath = config_path('telegram.php');
        $configContent = File::get($configPath);

        if (str_contains($configContent, $commandClass . '::class')) {
            $this->warn("{$commandClass} ya está registrado en config/telegram.php.");
            return;
        }

        $updated = preg_replace_callback(
            "/('commands'\s*=>\s*\[\s*)([^]]*)/s",
            function ($matches) use ($commandClass) {
                $existing = trim($matches[2]);
                $insertion = $existing ? $existing . ",\n            {$commandClass}::class" : "            {$commandClass}::class";
                return $matches[1] . $insertion;
            },
            $configContent
        );

        if ($updated) {
            File::put($configPath, $updated);
            $this->info("{$commandClass} registrado en config/telegram.php");
        } else {
            $this->error("No se pudo registrar {$commandClass} en config/telegram.php");
        }
    }
}
