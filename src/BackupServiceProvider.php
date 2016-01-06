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

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Vinkla\Backup\Commands\ListCommand;
use Vinkla\Backup\Commands\RunCommand;
use Vinkla\Backup\Sources\DatabaseSource;
use Zenstruck\Backup\Executor;
use Zenstruck\Backup\ProfileRegistry;

/**
 * This is the backup service provider class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class BackupServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->setupConfig($this->app);

        $this->commands(['command.backuplist', 'command.backuprun']);
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
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
     */
    public function register()
    {
        $this->registerExecutor($this->app);
        $this->registerBuilder($this->app);
        $this->registerFactory($this->app);
        $this->registerRegistry($this->app);
        $this->registerBindings($this->app);
        $this->registerSources($this->app);
        $this->registerRunCommand($this->app);
        $this->registerListCommand($this->app);
    }

    /**
     * Register the backup executor.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
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
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    protected function registerBuilder(Application $app)
    {
        $app->singleton('backup.builder', function ($app) {
            return new ProfileBuilderFactory($app);
        });

        $app->alias('backup.builder', ProfileBuilderFactory::class);
    }

    /**
     * Register the factory.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('backup.factory', function ($app) {
            $builder = $app['backup.builder'];

            return new ProfileFactory($builder);
        });

        $app->alias('backup.factory', ProfileFactory::class);
    }

    /**
     * Register the registry.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    protected function registerRegistry(Application $app)
    {
        $app->singleton('backup.registry', function ($app) {
            $factory = $app['backup.factory'];

            return new ProfileRegistryFactory($factory);
        });

        $app->alias('backup.registry', ProfileRegistryFactory::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    protected function registerBindings(Application $app)
    {
        $app->singleton('backup', function ($app) {
            $config = $app['config']['backup'];
            $registry = $app['backup.registry'];

            return $registry->make($config);
        });

        $app->alias('backup', ProfileRegistry::class);
    }

    /**
     * Register the sources.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
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
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    protected function registerListCommand(Application $app)
    {
        $app->singleton('command.backuplist', function ($app) {
            $connection = $app['backup'];

            return new ListCommand($connection);
        });
    }

    /**
     * Register the run command.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    protected function registerRunCommand(Application $app)
    {
        $app->singleton('command.backuprun', function ($app) {
            $connection = $app['backup'];
            $executor = $app['backup.executor'];

            return new RunCommand($connection, $executor);
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
            'backup.builder',
            'backup.executor',
            'backup.factory',
            'backup.registry',
            'command.backuplist',
            'command.backuprun',
        ];
    }
}
