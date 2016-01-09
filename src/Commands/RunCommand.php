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

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * This is the run command class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RunCommand extends AbstractCommand
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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $registry = $this->getRegistry();

        $profile = $registry->get((string) $this->argument('profile'));

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
