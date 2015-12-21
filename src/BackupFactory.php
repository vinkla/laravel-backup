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

use GrahamCampbell\Flysystem\FlysystemManager;
use Illuminate\Database\DatabaseManager;
use InvalidArgumentException;
use Zenstruck\Backup\Namer\SimpleNamer;
use Zenstruck\Backup\Namer\TimestampNamer;
use Zenstruck\Backup\Processor\GzipArchiveProcessor;
use Zenstruck\Backup\Processor\ZipArchiveProcessor;
use Zenstruck\Backup\Source\MySqlDumpSource;

/**
 * This is the backup factory class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class BackupFactory
{
    /**
     * The database manager instance.
     *
     * @var \Illuminate\Database\DatabaseManager
     */
    protected $database;

    /**
     * The flysystem instance.
     *
     * @var \GrahamCampbell\Flysystem\FlysystemManager
     */
    protected $flysystem;

    /**
     * Create a new backup factory instance.
     *
     * @param \Illuminate\Database\DatabaseManager $database
     * @param \GrahamCampbell\Flysystem\FlysystemManager $flysystem
     */
    public function __construct(DatabaseManager $database, FlysystemManager $flysystem)
    {
        $this->database = $database;
        $this->flysystem = $flysystem;
    }

    /**
     * Make a new backup client.
     *
     * @param array $config
     *
     * @return \Vinkla\Backup\Backup
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
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
        $keys = ['sources', 'destinations'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return [
            'name' => array_get($config, 'name', 'backup'),
            'sources' => array_get($config, 'sources'),
            'destinations' => array_get($config, 'destinations'),
            'namer' => $this->getNamer($config),
            'database' => $this->getDatabase($config),
            'processor' => $this->getArchiveProcessor($config),
        ];
    }

    /**
     * Get the archive processor.
     *
     * @param array $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Zenstruck\Backup\Processor\ArchiveProcessor
     */
    protected function getArchiveProcessor(array $config)
    {
        $processor = array_get($config, 'processor', 'gzip');

        switch ($processor) {
            case 'gzip':
                return new GzipArchiveProcessor('zip');
                break;
            case 'zip':
                return new ZipArchiveProcessor('zip');
                break;
        }

        throw new InvalidArgumentException("Unsupported processor [$processor].");
    }

    /**
     * Get the database.
     *
     * @param array $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Zenstruck\Backup\Source\MySqlDumpSource
     */
    protected function getDatabase(array $config)
    {
        $database = array_get($config, 'database', 'default');

        $config = $this->database->getConfig($database);

        $driver = $config['driver'];

        if ($driver !== 'mysql') {
            throw new InvalidArgumentException("Unsupported database driver [$driver].");
        }

        return new MySqlDumpSource($driver, $config['database'], $config['host'], $config['username'], $config['password']);
    }

    /**
     * Get the namer.
     *
     * @param array $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Zenstruck\Backup\Namer
     */
    protected function getNamer(array $config)
    {
        $namer = array_get($config, 'namer', 'timestamp');

        switch ($namer) {
            case 'timestamp':
                return new TimestampNamer('timestamp');
                break;
            case 'simple':
                return new SimpleNamer();
                break;
        }

        throw new InvalidArgumentException("Unsupported namer [$namer].");
    }

    /**
     * Get the backup client.
     *
     * @param array $config
     *
     * @return \Vinkla\Backup\Backup
     */
    protected function getClient(array $config)
    {
        return new Backup(
            array_get($config, 'name'),
            array_get($config, 'processor'),
            array_get($config, 'namer'),
            array_get($config, 'database'),
            array_get($config, 'sources'),
            array_get($config, 'destinations'),
            $this->flysystems
        );
    }
}
