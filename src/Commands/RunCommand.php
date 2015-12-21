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
use Psr\Log\LoggerInterface;
use Vinkla\Backup\Backup;
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
    protected $description = 'Backup the application';

    /**
     * The backup instance.
     *
     * @var \Vinkla\Backup\Backup
     */
    protected $backup;

    /**
     * The logger instance.
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Create a new run command instance.
     *
     * @param \Vinkla\Backup\Backup $backup
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(Backup $backup, LoggerInterface $logger)
    {
        $this->backup = $backup;
        $this->logger = $logger;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $executor = new Executor($this->logger);

        $executor->backup($this->backup->getProfile());
    }
}
