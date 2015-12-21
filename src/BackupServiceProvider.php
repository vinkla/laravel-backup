<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Backup;

use GrahamCampbell\Flysystem\FlysystemServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the backup service provider class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class BackupServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig($this->app);

        $this->commands('command.backup');
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function setupConfig(Application $app)
    {
        $source = realpath(__DIR__.'/../config/backup.php');

        if ($app instanceof LaravelApplication && $app->runningInConsole()) {
            $this->publishes([$source => config_path('backup.php')]);
        } elseif ($app instanceof LumenApplication) {
            $app->configure('backup');
        }

        $this->mergeConfigFrom($source, 'backup');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFlysystem($this->app);
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
        $this->registerBindings($this->app);
        $this->registerRunCommand($this->app);
    }

    /**
     * Register the flysystem service provider.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFlysystem(Application $app)
    {
        $app->register(FlysystemServiceProvider::class);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('backup.factory', function () use ($app) {
            $database = $app['db'];
            $flysystem = $app['flysystem'];

            return new BackupFactory($database, $flysystem);
        });

        $app->alias('backup.factory', BackupFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('backup', function ($app) {
            $config = $app['config'];
            $factory = $app['backup.factory'];

            return new BackupManager($config, $factory);
        });

        $app->alias('backup', BackupManager::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->bind('backup.connection', function ($app) {
            $manager = $app['backup'];

            return $manager->connection();
        });

        $app->alias('backup.connection', Backup::class);
    }

    /**
     * Register the run command.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerRunCommand(Application $app)
    {
        $app->singleton('command.backuprun', function ($app) {
            $backup = $app['backup'];
            $logger = $app['log'];

            return new RunCommand($backup, $logger);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'backup',
            'backup.factory',
            'backup.connection',
            'command.backup',
        ];
    }
}
