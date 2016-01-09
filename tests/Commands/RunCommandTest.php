<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup\Commands;

use Mockery;
use Vinkla\Backup\Commands\RunCommand;
use Vinkla\Backup\ProfileRegistryFactory;
use Zenstruck\Backup\Executor;

/**
 * This is the run command test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RunCommandTest extends AbstractCommandTestCase
{
    public function getCommand()
    {
        $registry = Mockery::mock(ProfileRegistryFactory::class);
        $executor = new Executor($this->app['log']);

        return new RunCommand(
            $this->app->config,
            $registry,
            $executor
        );
    }
}
