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

use Illuminate\Contracts\Container\Container;
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
        $this->setupConfig();

        $this->commands(['command.backup.list', 'command.backup.run']);
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/backup.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('backup.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('backup');
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
        $this->registerExecutor();
        $this->registerBuilder();
        $this->registerRegistry();
        $this->registerSources();
        $this->registerRunCommand();
        $this->registerListCommand();
    }

    /**
     * Register the backup executor.
     *
     * @return void
     */
    protected function registerExecutor()
    {
        $this->app->singleton('backup.executor', function (Container $app) {
            $logger = $app['log'];

            return new Executor($logger);
        });

        $this->app->alias('backup.executor', Executor::class);
    }

    /**
     * Register the builder.
     *
     * @return void
     */
    protected function registerBuilder()
    {
        $this->app->singleton('backup.builder', function (Container $app) {
            return new ProfileBuilderFactory($app);
        });

        $this->app->alias('backup.builder', ProfileBuilderFactory::class);
    }

    /**
     * Register the registry.
     *
     * @return void
     */
    protected function registerRegistry()
    {
        $this->app->singleton('backup.registry', function (Container $app) {
            $builder = $app['backup.builder'];

            return new ProfileRegistryFactory($builder);
        });

        $this->app->alias('backup.registry', ProfileRegistryFactory::class);
    }

    /**
     * Register the sources.
     *
     * @return void
     */
    protected function registerSources()
    {
        $this->app->bind(DatabaseSource::class, function (Container $app) {
            $config = $app['config'];

            return new DatabaseSource($config);
        });
    }

    /**
     * Register the list command.
     *
     * @return void
     */
    protected function registerListCommand()
    {
        $this->app->singleton('command.backup.list', function (Container $app) {
            $config = $app['config'];
            $registry = $app['backup.registry'];
            $executor = $app['backup.executor'];

            return new ListCommand($config, $registry, $executor);
        });
    }

    /**
     * Register the run command.
     *
     * @return void
     */
    protected function registerRunCommand()
    {
        $this->app->singleton('command.backup.run', function (Container $app) {
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
            'command.backup.list',
            'command.backup.run',
        ];
    }
}
