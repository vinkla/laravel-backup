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
use Symfony\Component\Console\Input\InputArgument;
use Vinkla\Backup\ProfileRegistryFactory;
use Zenstruck\Backup\Executor;

/**
 * This is the run command class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RunCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'backup:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a backup profile';

    /**
     * The backup instance.
     *
     * @var \Vinkla\Backup\ProfileRegistryFactory
     */
    protected $factory;

    /**
     * The executor instance.
     *
     * @var \Zenstruck\Backup\Executor
     */
    protected $executor;

    /**
     * Create a new run command instance.
     *
     * @param \Vinkla\Backup\ProfileRegistryFactory $factory
     * @param \Zenstruck\Backup\Executor $executor
     *
     * @return void
     */
    public function __construct(ProfileRegistryFactory $factory, Executor $executor)
    {
        $this->factory = $factory;
        $this->executor = $executor;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $registry = $this->factory->getProfileRegistry();

        if (!$this->argument('profile')) {
            $this->call('backup:list');
        }

        $profile = $registry->get($this->argument('profile'));

        $this->executor->backup($profile);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['profile', null, InputArgument::REQUIRED, 'The backup profile to run (leave blank for listing)'],
        ];
    }
}
