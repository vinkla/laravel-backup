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

use Illuminate\Database\DatabaseManager;
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
    protected $database;

    /**
     * Create a new backup factory instance.
     *
     * @param \Illuminate\Database\DatabaseManager $database
     */
    public function __construct(DatabaseManager $database)
    {
        $this->database = $database;
    }

    /**
     * Create and register the source.
     *
     * @param array $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Zenstruck\Backup\Source\MySqlDumpSource
     */
    public function create(array $config)
    {
        $config = $this->database->getDefaultConnection();

        $driver = $config['driver'];

        if ($driver !== 'mysql') {
            throw new InvalidArgumentException("Unsupported database driver [$driver].");
        }

        return new Source($driver, $config['database'], $config['host'], $config['username'], $config['password']);
    }
}
