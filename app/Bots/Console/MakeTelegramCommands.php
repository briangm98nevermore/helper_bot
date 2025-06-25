<?php

namespace App\Bots\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeTelegramCommands extends Command
{
    protected $signature = 'app:telegram-command
                            {name : The class name of the Telegram command (e.g. StartCommand)}
                            {bot? : The name of the bot (e.g. SupportBot). Defaults to DefaultBot}';

    protected $description = 'Create a new Telegram bot command class';

    public function handle(): void
    {
        $name = $this->argument('name');
        $bot = $this->argument('bot') ?? 'DefaultBot';

        $className = Str::studly($name);
        //$commandName = Str::snake($name, ':');str_replace('Command', '', $commandName);strtolower
        $commandName = strtolower(str_replace('Command', '', $name));
        $basePath = app_path("Bots/{$bot}/Commands");
        $filePath = "{$basePath}/{$className}.php";
        $namespace = "App\\Bots\\{$bot}\\Commands";

        if (File::exists($filePath)) {
            $this->error("El comando '{$className}' ya existe en {$basePath}.");
            return;
        }

        File::ensureDirectoryExists($basePath);

        $stub = <<<PHP
        <?php

        namespace {$namespace};

        use Telegram\Bot\Commands\Command;

        class {$className} extends Command
        {
            protected string \$name = '{$commandName}';
            protected string \$description = 'Descripción del comando {$className}';

            public function handle()
            {
                // Lógica del comando
            }
        }
        PHP;

        File::put($filePath, $stub);
        $this->info("Comando creado correctamente: {$filePath}");
    }
}
