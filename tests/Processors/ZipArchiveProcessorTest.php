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

use Vinkla\Backup\Processors\ZipArchiveProcessor;

/**
 * This is the zip archive processor test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ZipArchiveProcessorTest extends AbstractProcessorTestCase
{
    public function getFactory()
    {
        return new ZipArchiveProcessor();
    }
}
