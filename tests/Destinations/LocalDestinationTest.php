<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup\Destinations;

use Vinkla\Backup\Destinations\LocalDestination;
use Vinkla\Tests\Backup\AbstractTestCase;
use Vinkla\Tests\Backup\FactoryTrait;
use Zenstruck\Backup\Destination\StreamDestination;

/**
 * This is the stream destination test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class LocalDestinationTest extends AbstractTestCase
{
    use FactoryTrait;

    public function testBootstrap()
    {
        $this->assertInstanceOf(StreamDestination::class, $this->getFactory()->bootstrap());
    }

    public function getFactory()
    {
        return new LocalDestination();
    }
}
