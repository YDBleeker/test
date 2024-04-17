<?php

namespace Yonidebleeker\Webinsights;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WebinsightsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('webinsights')
            ->hasViews()
            ->hasRoute('web')
            ->hasMigrations('make_visitors_table', 'make_pagevisits_table', 'make_pages_table')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->askToRunMigrations();
            });
    }
}

//php artisan webinsights:install
//php artisan vendor:publish --tag=your-package-name-views
