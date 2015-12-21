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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the backup manager class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class BackupManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Vinkla\Backup\BackupFactory
     */
    private $factory;

    /**
     * Create a new backup manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Vinkla\Backup\BackupFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, BackupFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config, $this);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'backup';
    }

    /**
     * Get the factory instance.
     *
     * @return \Vinkla\Backup\BackupFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
