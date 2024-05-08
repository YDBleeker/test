<?php

namespace Yonidebleeker\Webinsights\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallTailwindCommand extends Command
{
    protected $signature = 'install:webinsights-tailwind';

    protected $description = 'Install Web Insights dependencies and scaffolding';

    public function handle()
    {
        $this->updateNodePackages(function ($packages) {
            return [
            "autoprefixer" => "^10.4.19",
            "laravel-vite-plugin" => "^1.0",
            "postcss" => "^8.4.38",
            "tailwindcss" => "^3.4.3",
            "vite" => "^5.0",
            ] + $packages;
        });

        $parentDir = dirname(dirname(__DIR__));


        copy($parentDir.'/tailwind.config.js', base_path('tailwind.config.js'));
        copy($parentDir.'/postcss.config.js', base_path('postcss.config.js'));
        copy($parentDir.'/vite.config.js', base_path('vite.config.js'));
        copy($parentDir.'/resources/css/app.css', resource_path('css/app.css'));
        copy($parentDir.'/resources/js/app.js', resource_path('js/app.js'));

        $this->info('Installing and building Node dependencies.');

        $commands = [];
        if (file_exists(base_path('pnpm-lock.yaml'))) {
            $commands = ['pnpm install', 'pnpm run build'];
        } elseif (file_exists(base_path('yarn.lock'))) {
            $commands = ['yarn install', 'yarn run build'];
        } else {
            $commands = ['npm install', 'npm run build'];
        }

        if (!empty($commands)) {
            $this->runCommands($commands);
        }

        $this->line('');
        $this->info('Web Insights installed successfully.');
    }

    protected function runCommands(array $commands)
    {
        foreach ($commands as $command) {
            $this->line("Running command: $command");
            system($command);
        }
    }


    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     *
     * @return void
     */
    protected static function flushNodeModules()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }
}
