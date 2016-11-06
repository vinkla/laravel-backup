<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Backup;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Vinkla\Backup\Sources\DatabaseSource;
use Zenstruck\Backup\Executor;
use Zenstruck\Backup\ProfileBuilder;
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
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
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
        $this->registerProfileBuilder();
        $this->registerProfileRegistry();
        $this->registerDatabaseSource();
        $this->registerBackup();
    }

    /**
     * Register the executor class.
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
     * Register the profile builder class.
     *
     * @return void
     */
    protected function registerProfileBuilder()
    {
        $this->app->singleton('backup.builder', function (Container $app) {
            $config = $app['config']['backup'];

            $factory = new ProfileBuilderFactory($app);

            return $factory->make($config);
        });

        $this->app->alias('backup.builder', ProfileBuilder::class);
    }

    /**
     * Register the profile registry class.
     *
     * @return void
     */
    protected function registerProfileRegistry()
    {
        $this->app->singleton('backup.registry', function (Container $app) {
            $config = $app['config']['backup'];
            $builder = $app['backup.builder'];

            $factory = new ProfileRegistryFactory($builder);

            return $factory->make($config);
        });

        $this->app->alias('backup.registry', ProfileRegistry::class);
    }

    /**
     * Register the database source class.
     *
     * @return void
     */
    protected function registerDatabaseSource()
    {
        $this->app->bind(DatabaseSource::class, function (Container $app) {
            $config = $app['config'];

            return new DatabaseSource($config);
        });
    }

    /**
     * Register the backup class.
     *
     * @return void
     */
    protected function registerBackup()
    {
        $this->app->singleton('backup', function (Container $app) {
            $config = $app['config'];
            $registry = $app['backup.registry'];
            $executor = $app['backup.executor'];

            return new Backup($config, $registry, $executor);
        });

        $this->app->alias('backup', Backup::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'backup',
            'backup.builder',
            'backup.executor',
            'backup.registry',
        ];
    }
}
