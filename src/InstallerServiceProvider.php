<?php

namespace Kamrankhandev\Installer;

use Illuminate\Support\ServiceProvider;

class InstallerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $config = __DIR__ . '/config/install.php';
        $this->mergeConfigFrom($config, 'install');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'installer');
    }
}
