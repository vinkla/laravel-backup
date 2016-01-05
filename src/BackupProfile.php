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

use Illuminate\Contracts\Config\Repository;

/**
 * This is the backup profile class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class BackupProfile
{
    /**
     * The config repository instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * The profile factory instance.
     *
     * @var \Vinkla\Backup\ProfileFactory
     */
    protected $factory;

    /**
     * Create a new backup profile instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Vinkla\Backup\ProfileFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, ProfileFactory $factory)
    {
        $this->config = $config;
        $this->factory = $factory;
    }

    /**
     * Get the backup profile instance.
     *
     * @return \Zenstruck\Backup\Profile
     */
    public function get()
    {
        return $this->factory->make($this->config->get('backup'));
    }
}
