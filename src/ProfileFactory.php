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
use InvalidArgumentException;
use Zenstruck\Backup\Profile;

/**
 * This is the profile factory class,.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileFactory
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Create a new profile factory.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Make a new profile.
     *
     * @param array $config
     *
     * @return \Zenstruck\Backup\Profile
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getProfile($config);
    }

    /**
     * Get the configuration data.
     *
     * @param array $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        $keys = ['sources', 'destinations', 'processor', 'namer'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return $config;
    }

    /**
     * Get the profile.
     *
     * @param array $config
     *
     * @return \Zenstruck\Backup\Profile
     */
    protected function getProfile(array $config)
    {
        return new Profile(
            'default',
            array_get($config, 'path', storage_path('backups')),
            array_get($config, 'processor'),
            array_get($config, 'namer'),
            $this->create(array_get($config, 'sources')),
            $this->create(array_get($config, 'destinations'))
        );
    }

    /**
     * Make multiple objects using the container.
     *
     * @param string [] $classes
     *
     * @return object[]
     */
    protected function create($classes)
    {
        foreach ($classes as $index => $class) {
            $classes[$index] = $this->app->make($class)->create();
        }

        return $classes;
    }
}
