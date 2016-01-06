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
use Zenstruck\Backup\ProfileRegistry;

/**
 * This is the profile registry factory class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileRegistryFactory
{
    /**
     * The profile factory instance.
     *
     * @var \Vinkla\Backup\ProfileFactory
     */
    protected $profile;

    /**
     * Create a new profile registry factory instance.
     *
     * @param \Vinkla\Backup\ProfileFactory $profile
     *
     * @return void
     */
    public function __construct(ProfileFactory $profile)
    {
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

        return $config;
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
     * @param array $config
     *
     * @return \Zenstruck\Backup\ProfileRegistry
     */
    protected function getProfileRegistry(array $config)
    {
        $registry = new ProfileRegistry();

        foreach (array_get($config, 'profiles') as $name => $profile) {
            $profile = $this->createProfile(array_add($profile, 'name', $name));
            
            $registry->add($profile);
        }

        return $registry;
    }
}
