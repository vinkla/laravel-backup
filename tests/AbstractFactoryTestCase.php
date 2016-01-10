<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup;

use Vinkla\Backup\FactoryInterface;

/**
 * This is the abstract factory test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractFactoryTestCase extends AbstractTestCase
{
    public function testImplementsFactoryInterface()
    {
        $this->assertInstanceOf(FactoryInterface::class, $this->getFactory());
    }

    public function testNameIsString()
    {
        $this->assertTrue(is_string($this->getFactory()->getName()));
    }

    abstract public function getFactory();
}
