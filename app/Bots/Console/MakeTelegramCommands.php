<?php

namespace App\Bots\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeTelegramCommands extends Command
{
    protected $signature = 'bot:telegram-command {name : Nombre del comando}';
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

        // Generamos el contenido del comando
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

        $this->registerInBotKernel($class);
    }

    protected function registerInBotKernel(string $commandClass): void
    {
        $kernelPath = app_path('Bots/DefaultBot/Kernel.php');

        if (!File::exists($kernelPath)) {
            $this->error("No se encontró el archivo Kernel en: {$kernelPath}");
            return;
        }

        $kernelContent = File::get($kernelPath);
        $commandClass = '\\' . ltrim($commandClass, '\\');

        if (str_contains($kernelContent, $commandClass . '::class')) {
            $this->warn("{$commandClass} ya está registrado en Kernel.php.");
            return;
        }

        // Inserta antes del cierre del array de return
        $updated = preg_replace_callback(
            '/(return\s*\[\s*)([^]]*)(\];)/s',
            function ($matches) use ($commandClass) {
                $existing = trim($matches[2]);
                $insertion = $existing
                    ? $existing . ",\n            {$commandClass}::class"
                    : "            {$commandClass}::class";
                return $matches[1] . $insertion . "\n        " . $matches[3];
            },
            $kernelContent
        );

        if ($updated) {
            File::put($kernelPath, $updated);
            $this->info("{$commandClass} registrado en Kernel.php correctamente.");
        } else {
            $this->error("No se pudo registrar {$commandClass} en Kernel.php.");
        }
    }
}
