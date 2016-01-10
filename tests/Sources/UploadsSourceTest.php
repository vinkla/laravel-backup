<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup\Sources;

use Vinkla\Backup\Sources\UploadsSource;
use Vinkla\Tests\Backup\AbstractFactoryTestCase;
use Zenstruck\Backup\Source\RsyncSource;

/**
 * This is the rsync source test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class UploadsSourceTest extends AbstractFactoryTestCase
{
    public function testBootstrap()
    {
        $this->assertInstanceOf(RsyncSource::class, $this->getFactory()->bootstrap());
    }

    public function getFactory()
    {
        return new UploadsSource();
    }
}
