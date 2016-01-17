<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Backup\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Vinkla\Backup\ProfileRegistryFactory;
use Zenstruck\Backup\Executor;

/**
 * This is the abstract command class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractCommand extends Command
{
    /**
     * The config repository instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * The profile registry instance.
     *
     * @var \Vinkla\Backup\ProfileRegistryFactory
     */
    protected $registry;

    /**
     * The executor instance.
     *
     * @var \Zenstruck\Backup\Executor
     */
    protected $executor;

    /**
     * Create a new abstract command instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Vinkla\Backup\ProfileRegistryFactory $registry
     * @param \Zenstruck\Backup\Executor $executor
     *
     * @return void
     */
    public function __construct(Repository $config, ProfileRegistryFactory $registry, Executor $executor)
    {
        $this->config = $config;
        $this->registry = $registry;
        $this->executor = $executor;

        parent::__construct();
    }

    /**
     * Get the profile name.
     *
     * @return string
     */
    protected function getProfileName()
    {
        if (is_string($this->argument('profile'))) {
            return $this->argument('profile');
        }

        return $this->config->get('backup.default');
    }

    /**
     * Get the profile registry.
     *
     * @return \Zenstruck\Backup\ProfileRegistry
     */
    protected function getRegistry()
    {
        $config = $this->config->get('backup');

        return $this->registry->make($config);
    }
}
