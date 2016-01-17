<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup\Namers;

use Vinkla\Backup\Namers\NamerInterface;
use Vinkla\Tests\Backup\AbstractTestCase;

/**
 * This is the abstract namer test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractNamerTestCase extends AbstractTestCase
{
    public function testImplementsNamerInterface()
    {
        $this->assertInstanceOf(NamerInterface::class, $this->getNamer());
    }

    public function testNameIsString()
    {
        $this->assertTrue(is_string($this->getNamer()->getName()));
    }

    abstract public function getNamer();
}
