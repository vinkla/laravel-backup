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
use Zenstruck\Backup\Destination\FlysystemDestination;
use Zenstruck\Backup\Destination\StreamDestination;
use Zenstruck\Backup\Namer;
use Zenstruck\Backup\Processor;
use Zenstruck\Backup\Profile;
use Zenstruck\Backup\Source;
use Zenstruck\Backup\Source\MySqlDumpSource;
use Zenstruck\Backup\Source\RsyncSource;

/**
 * This is the backup class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Backup
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Zenstruck\Backup\Processor
     */
    protected $processor;

    /**
     * @var \Zenstruck\Backup\Namer
     */
    protected $namer;

    /**
     * @var \Zenstruck\Backup\Source
     */
    protected $database;

    /**
     * The sources array.
     *
     * @var array
     */
    protected $sources;

    /**
     * The destinations array.
     *
     * @var array
     */
    protected $destinations;

    /**
     * The flysystem instance.
     *
     * @var \GrahamCampbell\Flysystem\FlysystemManager
     */
    protected $flysystem;

    /**
     * Create a new backup instance.
     *
     * @param string $name
     * @param \Zenstruck\Backup\Processor $processor
     * @param \Zenstruck\Backup\Namer $namer
     * @param \Zenstruck\Backup\Source\MySqlDumpSource $database
     * @param array $sources
     * @param array $destinations
     * @param \GrahamCampbell\Flysystem\FlysystemManager $flysystem
     */
    public function __construct($name, Processor $processor, Namer $namer, MySqlDumpSource $database, array $sources, array $destinations, FlysystemManager $flysystem)
    {
        $this->name = $name;
        $this->processor = $processor;
        $this->namer = $namer;
        $this->database = $database;
        $this->sources = $sources;
        $this->destinations = $destinations;
        $this->flysystem = $flysystem;
    }

    /**
     * Get the profile instance.
     *
     * @return \Zenstruck\Backup\Profile
     */
    public function getProfile()
    {
        $sources = $this->getSources();
        $destinations = $this->getDestinations();

        return new Profile(
            $this->name,
            storage_path('backups'),
            $this->processor,
            $this->namer,
            $sources,
            $destinations
        );
    }

    /**
     * Get the sources array.
     *
     * @return array
     */
    protected function getSources()
    {
        $sources = [$this->database];

        foreach ($this->sources as $source) {
            $sources[] = new RsyncSource('files', $source);
        }

        return $sources;
    }

    /**
     * Get the destinations array.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     * @return array
     */
    protected function getDestinations()
    {
        $destinations = [];

        foreach ($this->destinations as $filesystem => $path) {
            if ($filesystem === 'local') {
                $destination = [new StreamDestination($filesystem, $path)];
            } else {
                $destination = [new FlysystemDestination($this->flysystem->connection($filesystem), $path)];
            }

            $destinations[] = $destination;
        }

        return $destinations;
    }
}
