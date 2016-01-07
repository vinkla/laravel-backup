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
     * The profile builder factory.
     *
     * @var \Vinkla\Backup\ProfileBuilderFactory
     */
    protected $builder;

    /**
     * The profile factory.
     *
     * @var \Vinkla\Backup\ProfileFactory
     */
    protected $profile;

    /**
     * Create a new profile registry factory instance.
     *
     * @param \Vinkla\Backup\ProfileBuilderFactory $builder
     * @param \Vinkla\Backup\ProfileFactory $profile
     */
    public function __construct(ProfileBuilderFactory $builder, ProfileFactory $profile)
    {
        $this->builder = $builder;
        $this->profile = $profile;
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

        $builder = $this->createBuilder($config);

        return $this->getProfileRegistry($builder, $config);
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

        return $config;
    }

    /**
     * Create a new profile builder.
     *
     * @param array $config
     *
     * @return \Zenstruck\Backup\Profile
     */
    private function createBuilder(array $config)
    {
        return $this->builder->make($config);
    }

    /**
     * Create a new profile.
     *
     * @param array $config
     *
     * @return \Zenstruck\Backup\Profile
     */
    protected function createProfile(array $config)
    {
        return $this->profile->make($config);
    }

    /**
     * Get the profile registry.
     *
     * @param \Zenstruck\Backup\ProfileBuilder $builder
     * @param array $config
     *
     * @return \Zenstruck\Backup\ProfileRegistry
     */
    protected function getProfileRegistry(ProfileBuilder $builder, array $config)
    {
        $registry = new ProfileRegistry();

        foreach (array_get($config, 'profiles') as $name => $profile) {
            $profile = $this->createProfile(array_add($profile, 'name', $name));

            $profile = $builder->create(
                $profile->getName(),
                $profile->getScratchDir(),
                $profile->getProcessor(),
                $profile->getNamer(),
                $profile->getSources(),
                $profile->getDestinations()
            );

            $registry->add($profile);
        }

        return $registry;
    }
}
