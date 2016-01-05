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
use Vinkla\Backup\BackupProfile;
use Zenstruck\Backup\Profile;

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
    protected $description = 'List backups';

    /**
     * The profile instance.
     *
     * @var \Vinkla\Backup\BackupProfile
     */
    protected $profile;

    /**
     * Create a new list command instance.
     *
     * @param \Vinkla\Backup\BackupProfile $profile
     *
     * @return void
     */
    public function __construct(BackupProfile $profile)
    {
        $this->profile = $profile;

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
        $profile = $this->profile->get();

        foreach ($profile->getDestinations() as $destination) {
            $this->line('');
            $this->info(sprintf('Existing backups for %s', $destination->getName()));

            $headers = ['Key', 'Size', 'Created At'];
            $rows = [];

            foreach ($destination->all() as $backup) {
                $rows[] = [
                    $backup->getKey(),
                    $backup->getSize(),
                    $backup->getCreatedAt()->format('Y-m-d H:i:s'),
                ];
            }

            $this->table($headers, $rows);
            $this->line('');
        }

        return 0;
    }
}
