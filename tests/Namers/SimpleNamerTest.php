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

use Vinkla\Backup\Namers\SimpleNamer;
use Vinkla\Tests\Backup\AbstractTestCase;
use Vinkla\Tests\Backup\FactoryTrait;
use Zenstruck\Backup\Namer\SimpleNamer as Namer;

/**
 * This is the simple namer test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class SimpleNamerTest extends AbstractTestCase
{
    use FactoryTrait;

    public function testBootstrap()
    {
        $this->assertInstanceOf(Namer::class, $this->getFactory()->bootstrap());
    }

    public function getFactory()
    {
        return new SimpleNamer();
    }
}
