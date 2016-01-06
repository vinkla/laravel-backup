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

use InvalidArgumentException;
use Zenstruck\Backup\ProfileBuilder;

/**
 * This is the profile factory class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileFactory
{
    /**
     * The profile builder factory instance.
     *
     * @var \Vinkla\Backup\ProfileBuilderFactory
     */
    protected $builder;

    /**
     * Create a new profile registry builder instance.
     *
     * @param \Vinkla\Backup\ProfileBuilderFactory $builder
     */
    public function __construct(ProfileBuilderFactory $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Make the profile.
     *
     * @param array $config
     *
     * @return \Zenstruck\Backup\Profile
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        $builder = $this->createBuilder($config);

        return $this->getProfile($builder, $config);
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
        $keys = ['name', 'sources', 'destinations', 'processor', 'namer'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing profile configuration key [$key].");
            }
        }

        return $config;
    }

    /**
     * Create the profile builder.
     *
     * @param array $config
     *
     * @return \Zenstruck\Backup\ProfileBuilder
     */
    protected function createBuilder($config)
    {
        return $this->builder->make($config);
    }

    /**
     * Get the profile.
     *
     * @param \Zenstruck\Backup\ProfileBuilder $builder
     * @param array                            $config
     *
     * @return \Zenstruck\Backup\Profile
     */
    protected function getProfile(ProfileBuilder $builder, array $config)
    {
        return $builder->create(
            array_get($config, 'name'),
            array_get($config, 'scratch_dir', storage_path('backups')),
            array_get($config, 'processor'),
            array_get($config, 'namer'),
            array_get($config, 'sources'),
            array_get($config, 'destinations')
        );
    }
}
