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
use Vinkla\Backup\Sources\MysqlDumpSource;
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
        $this->registerExecutor($this->app);
        $this->registerFactory($this->app);
        $this->registerProfile($this->app);
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
     * Register the factory.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('backup.factory', function ($app) {
            return new ProfileFactory($app);
        });

        $app->alias('backup.factory', ProfileFactory::class);
    }

    /**
     * Register the profile.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerProfile(Application $app)
    {
        $app->singleton('backup.profile', function ($app) {
            $config = $app['config'];
            $factory = $app['backup.factory'];

            return new BackupProfile($config, $factory);
        });

        $app->alias('backup.profile', BackupProfile::class);
    }

    /**
     * Register the sources.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerSources(Application $app)
    {
        $app->bind(MysqlDumpSource::class, function ($app) {
            $config = $app['config'];

            return new MysqlDumpSource($config);
        });
    }

    /**
     * Register the list command.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerListCommand(Application $app)
    {
        $app->singleton('command.backuplist', function ($app) {
            $profile = $app['backup.profile'];

            return new ListCommand($profile);
        });
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
            $profile = $app['backup.profile'];
            $executor = $app['backup.executor'];

            return new RunCommand($profile, $executor);
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
            'backup.executor',
            'backup.factory',
            'backup.profile',
            'command.backuplist',
            'command.backuprun',
        ];
    }
}
