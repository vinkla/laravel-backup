<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup\Processors;

use Vinkla\Backup\Processors\ZipProcessor;
use Vinkla\Tests\Backup\AbstractFactoryTestCase;
use Zenstruck\Backup\Processor\ZipArchiveProcessor;

/**
 * This is the zip archive processor test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ZipProcessorTest extends AbstractFactoryTestCase
{
    public function testBootstrap()
    {
        $this->assertInstanceOf(ZipArchiveProcessor::class, $this->getFactory()->bootstrap());
    }

    public function getFactory()
    {
        return new ZipProcessor();
    }
}
