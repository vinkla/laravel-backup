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
use RuntimeException;
use Vinkla\Backup\ProfileRegistryFactory;

/**
 * This is the list command class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ListCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'backup:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List backup profiles';

    /**
     * The factory instance.
     *
     * @var \Vinkla\Backup\ProfileRegistryFactory
     */
    protected $factory;

    /**
     * Create a new list command instance.
     *
     * @param \Vinkla\Backup\ProfileRegistryFactory $factory
     *
     * @return void
     */
    public function __construct(ProfileRegistryFactory $factory)
    {
        $this->factory = $factory;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws \RuntimeException
     *
     * @return mixed
     */
    public function handle()
    {
        $registry = $this->factory->getProfileRegistry();

        if (0 === count($registry)) {
            throw new RuntimeException('No profiles configured.');
        }

        $this->info('Available Profiles:');
        $this->line();

        $headers = ['Name', 'Processor', 'Namer', 'Sources', 'Destinations'];
        $rows = [];

        foreach ($registry as $profile) {
            $rows[] = [
                $profile->getName(),
                $profile->getProcessor()->getName(),
                $profile->getNamer()->getName(),
                implode(', ', array_keys($profile->getSources())),
                implode(', ', array_keys($profile->getDestinations())),
            ];
        }

        $this->table($headers, $rows);
    }
}
