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

use Vinkla\Backup\Commands\RunCommand;

/**
 * This is the run command test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RunCommandTest extends AbstractCommandTestCase
{
    public function getCommand()
    {
        return new RunCommand(
            $this->app->config,
            $this->getRegistry(),
            $this->getExecutor()
        );
    }
}
