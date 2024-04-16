<?php

namespace Yonidebleeker\Webinsights;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

class WebinsightsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('webinsights')
            ->hasViews()
            ->hasRoute('web')
            ->hasMigrations('make_visitors_table', 'make_pagevisits_table', 'make_pages_table')
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->askToRunMigrations();
                    //->publishViews();
            });
    }
}

//php artisan webinsights:install

