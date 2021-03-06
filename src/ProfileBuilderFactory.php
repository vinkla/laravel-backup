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

use Illuminate\Contracts\Foundation\Application;
use InvalidArgumentException;
use Zenstruck\Backup\ProfileBuilder;

/**
 * This is the profile builder factory class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileBuilderFactory
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Create a new profile builder factory.
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
     * Make the profile builder.
     *
     * @param array $config
     *
     * @return \Zenstruck\Backup\ProfileBuilder
     */
    public function make(array $config): ProfileBuilder
    {
        $config = $this->getConfig($config);

        return $this->getProfileBuilder($config);
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
    protected function getConfig(array $config): array
    {
        $keys = ['sources', 'destinations', 'processors', 'namers'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return $config;
    }

    /**
     * Get the profile builder.
     *
     * @param array $config
     *
     * @return \Zenstruck\Backup\ProfileBuilder
     */
    protected function getProfileBuilder(array $config): ProfileBuilder
    {
        return new ProfileBuilder(
            $this->bootstrap(array_get($config, 'processors')),
            $this->bootstrap(array_get($config, 'namers')),
            $this->bootstrap(array_get($config, 'sources')),
            $this->bootstrap(array_get($config, 'destinations'))
        );
    }

    /**
     * Make multiple objects using the container.
     *
     * @param array $classes
     *
     * @return object[]
     */
    protected function bootstrap(array $classes): array
    {
        foreach ($classes as $index => $class) {
            $classes[$index] = $this->app->make($class)->bootstrap();
        }

        return $classes;
    }
}
