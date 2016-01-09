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

/**
 * This is the list command class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ListCommand extends AbstractCommand
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
     * Execute the console command.
     *
     * @throws \RuntimeException
     *
     * @return mixed
     */
    public function handle()
    {
        $registry = $this->getRegistry();

        if (0 === count($registry)) {
            $this->error('No profiles configured.');

            return 1;
        }

        $profile = $registry->get((string) $this->argument('profile'));

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

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['profile', InputArgument::REQUIRED, 'The backup profile to list backups for'],
        ];
    }
}
