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
use Symfony\Component\Console\Input\InputOption;
use Vinkla\Backup\BackupProfile;
use Zenstruck\Backup\Executor;
use Zenstruck\Backup\Profile;

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
     * The profile instance.
     *
     * @var \Vinkla\Backup\BackupProfile
     */
    protected $profile;

    /**
     * The executor instance.
     *
     * @var \Zenstruck\Backup\Executor
     */
    protected $executor;

    /**
     * Create a new run command instance.
     *
     * @param \Vinkla\Backup\BackupProfile $profile
     * @param \Zenstruck\Backup\Executor $executor
     *
     * @return void
     */
    public function __construct(BackupProfile $profile, Executor $executor)
    {
        $this->profile = $profile;
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
        $profile = $this->profile->get();

        $this->executor->backup($profile, $this->option('clear'));

        $this->info('Profile was successfully backed up!');

        return 0;
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
