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

use Vinkla\Backup\Namers\TimestampNamer;
use Vinkla\Tests\Backup\AbstractFactoryTestCase;
use Zenstruck\Backup\Namer\TimestampNamer as Namer;

/**
 * This is the timestamp namer test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class TimestampNamerTest extends AbstractFactoryTestCase
{
    public function testBootstrap()
    {
        $this->assertInstanceOf(Namer::class, $this->getFactory()->bootstrap());
    }

    public function getFactory()
    {
        return new TimestampNamer();
    }
}
