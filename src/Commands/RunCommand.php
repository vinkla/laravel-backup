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
use Symfony\Component\Console\Input\InputOption;
use Zenstruck\Backup\Executor;
use Zenstruck\Backup\Profile;
use Zenstruck\Backup\ProfileRegistry;

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
     * The profile registry instance.
     *
     * @var \Zenstruck\Backup\ProfileRegistry
     */
    protected $registry;

    /**
     * The executor instance.
     *
     * @var \Zenstruck\Backup\Executor
     */
    protected $executor;

    /**
     * Create a new run command instance.
     *
     * @param \Zenstruck\Backup\ProfileRegistry $registry
     * @param \Zenstruck\Backup\Executor        $executor
     */
    public function __construct(ProfileRegistry $registry, Executor $executor)
    {
        $this->registry = $registry;
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
        $profile = $this->registry->get($this->argument('profile'));

        $this->executor->backup($profile, $this->option('clear'));

        $this->info('Profile was successfully backed up!');

        return 0;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['profile', InputArgument::REQUIRED, 'The backup profile to run'],
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['clear', null, InputOption::VALUE_NONE, 'Set this flag to clear scratch directory before backup'],
        ];
    }
}
