<?php

namespace Yonidebleeker\Webinsights;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Yonidebleeker\Webinsights\Commands\InstallTailwindCommand;

class WebinsightsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('webinsights')
            ->hasViews()
            ->hasRoute('web')
            ->hasMigrations('make_visitors_table', 'make_pagevisits_table', 'make_pages_table')
            ->hasCommand(InstallTailwindCommand::class)
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->askToRunMigrations();
            });
    }


//php artisan webinsights:install
//php artisan vendor:publish --tag=your-package-name-views or add folder in tailwind.config.js
}
