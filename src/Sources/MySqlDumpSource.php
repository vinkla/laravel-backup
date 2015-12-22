<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Backup\Sources;

use Illuminate\Contracts\Config\Repository;
use InvalidArgumentException;
use Zenstruck\Backup\Source\MySqlDumpSource as Source;

/**
 * This is the mysql dump source class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class MySqlDumpSource implements SourceInterface
{
    /**
     * The database manager instance.
     *
     * @var \Illuminate\Database\DatabaseManager
     */
    protected $config;

    /**
     * Create a new backup factory instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     *
     * @return void
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Create and register the source.
     *
     * @throws \InvalidArgumentException
     *
     * @return \Zenstruck\Backup\Source\MySqlDumpSource
     */
    public function create()
    {
        $connection = $this->getDatabaseConnection();

        $config = $this->config->get("database.connections.$connection");

        if ($config['driver'] !== 'mysql') {
            throw new InvalidArgumentException("Unsupported database driver [{$config['driver']}].");
        }

        return new Source($config['driver'], $config['database'], $config['host'], $config['username'], $config['password']);
    }

    /**
     * Get the database driver.
     *
     * @return string
     */
    public function getDatabaseConnection()
    {
        return $this->config->get('database.default');
    }
}
