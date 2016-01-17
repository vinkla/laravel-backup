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

use Illuminate\Contracts\Container\Container as Application;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Vinkla\Backup\Commands\ListCommand;
use Vinkla\Backup\Commands\RunCommand;
use Vinkla\Backup\Sources\DatabaseSource;
use Zenstruck\Backup\Executor;

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

        $this->commands(['command.backuplist', 'command.backuprun']);
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Container\Container $app
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
        $this->registerExecutor($this->app);
        $this->registerBuilder($this->app);
        $this->registerRegistry($this->app);
        $this->registerSources($this->app);
        $this->registerRunCommand($this->app);
        $this->registerListCommand($this->app);
    }

    /**
     * Register the backup executor.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerExecutor(Application $app)
    {
        $app->singleton('backup.executor', function ($app) {
            $logger = $app['log'];

            return new Executor($logger);
        });

        $app->alias('backup.executor', Executor::class);
    }

    /**
     * Register the builder.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerBuilder(Application $app)
    {
        $app->singleton('backup.builder', function ($app) {
            return new ProfileBuilderFactory($app);
        });

        $app->alias('backup.builder', ProfileBuilderFactory::class);
    }

    /**
     * Register the registry.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerRegistry(Application $app)
    {
        $app->singleton('backup.registry', function ($app) {
            $builder = $app['backup.builder'];

            return new ProfileRegistryFactory($builder);
        });

        $app->alias('backup.registry', ProfileRegistryFactory::class);
    }

    /**
     * Register the sources.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerSources(Application $app)
    {
        $app->bind(DatabaseSource::class, function ($app) {
            $config = $app['config'];

            return new DatabaseSource($config);
        });
    }

    /**
     * Register the list command.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerListCommand(Application $app)
    {
        $app->singleton('command.backuplist', function ($app) {
            $config = $app['config'];
            $registry = $app['backup.registry'];
            $executor = $app['backup.executor'];

            return new ListCommand($config, $registry, $executor);
        });
    }

    /**
     * Register the run command.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerRunCommand(Application $app)
    {
        $app->singleton('command.backuprun', function ($app) {
            $config = $app['config'];
            $registry = $app['backup.registry'];
            $executor = $app['backup.executor'];

            return new RunCommand($config, $registry, $executor);
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
            'backup.builder',
            'backup.executor',
            'backup.registry',
            'command.backuplist',
            'command.backuprun',
        ];
    }
}
