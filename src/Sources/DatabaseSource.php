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
use Zenstruck\Backup\Source\MySqlDumpSource;

/**
 * This is the database source class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class DatabaseSource implements SourceInterface
{
    /**
     * The config repository instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * Create a new database source instance.
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
     * Bootstrap the source.
     *
     * @throws \InvalidArgumentException
     *
     * @return \Zenstruck\Backup\Source\MySqlDumpSource
     */
    public function bootstrap(): MySqlDumpSource
    {
        $connection = $this->getDatabaseConnection();

        $config = $this->config->get("database.connections.$connection");

        if (array_get($config, 'driver') !== 'mysql') {
            throw new InvalidArgumentException("Unsupported database driver [{$config['driver']}].");
        }

        return new MySqlDumpSource(
            $this->getName(),
            array_get($config, 'database'),
            array_get($config, 'host'),
            array_get($config, 'username'),
            array_get($config, 'password')
        );
    }

    /**
     * Get the database driver.
     *
     * @return string
     */
    protected function getDatabaseConnection(): string
    {
        return $this->config->get('database.default');
    }

    /**
     * Get the source name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'database';
    }
}
