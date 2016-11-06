<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\Backup\Destinations;

use Vinkla\Backup\Destinations\DestinationInterface;
use Vinkla\Tests\Backup\AbstractTestCase;

/**
 * This is the abstract destination test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractDestinationTestCase extends AbstractTestCase
{
    public function testImplementsDestinationInterface()
    {
        $this->assertInstanceOf(DestinationInterface::class, $this->getDestination());
    }

    public function testNameIsString()
    {
        $this->assertTrue(is_string($this->getDestination()->getName()));
    }

    abstract public function getDestination();
}
