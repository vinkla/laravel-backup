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

use Vinkla\Tests\Backup\AbstractTestCase;

/**
 * This is the abstract command test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractCommandTestCase extends AbstractTestCase
{
    public function testConfiguration()
    {
        $command = $this->getCommand();

        $this->assertNotNull($command->getName());
        $this->assertTrue(is_string($command->getName()));

        $this->assertNotNull($command->getDescription());
        $this->assertTrue(is_string($command->getDescription()));
    }

    abstract public function getCommand();
}
