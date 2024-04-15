<?php

namespace Yonidebleeker\Webinsights;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;// Add this line to import InstallCommand

class WebinsightsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('webinsights')
            ->hasViews('webinsights::dashboard')
            ->hasRoute('web')
            ->hasMigrations('make_visitors_table', 'make_pagevisits_table', 'make_pages_table')
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->askToRunMigrations();
            });
    }
}

//php artisan your-package-name:install

