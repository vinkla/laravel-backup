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
use Zenstruck\Backup\ProfileRegistry;

/**
 * This is the profile registry factory class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileRegistryFactory
{
    /**
     * The profile builder.
     *
     * @var \Zenstruck\Backup\ProfileBuilder
     */
    protected $builder;

    /**
     * Create a new profile registry factory instance.
     *
     * @param \Zenstruck\Backup\ProfileBuilder $builder
     *
     * @return void
     */
    public function __construct(ProfileBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Make the profile registry.
     *
     * @param array $config
     *
     * @return \Zenstruck\Backup\ProfileRegistry
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getProfileRegistry($config);
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
        if (!array_key_exists('profiles', $config)) {
            throw new InvalidArgumentException('Missing configuration key [profiles].');
        }

        foreach (array_get($config, 'profiles') as $profile) {
            $keys = ['sources', 'destinations', 'processor', 'namer'];

            foreach ($keys as $key) {
                if (!array_key_exists($key, $profile)) {
                    throw new InvalidArgumentException("Missing profile configuration key [$key].");
                }
            }
        }

        return $config;
    }

    /**
     * Get the profile registry.
     *
     * @param array $config
     *
     * @return \Zenstruck\Backup\ProfileRegistry
     */
    protected function getProfileRegistry(array $config)
    {
        $registry = new ProfileRegistry();

        foreach (array_get($config, 'profiles') as $name => $profile) {
            $profile = $this->builder->create(
                $name,
                array_get($profile, 'scratch_dir', storage_path('backups')),
                array_get($profile, 'processor'),
                array_get($profile, 'namer'),
                array_get($profile, 'sources'),
                array_get($profile, 'destinations')
            );

            $registry->add($profile);
        }

        return $registry;
    }
}
