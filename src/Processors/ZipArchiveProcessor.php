<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Backup\Processors;

use Vinkla\Backup\FactoryInterface;
use Zenstruck\Backup\Processor\ZipArchiveProcessor as Processor;

/**
 * This is the zip archive processor class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ZipArchiveProcessor implements FactoryInterface
{
    /**
     * Create and register the processor.
     *
     * @return \Zenstruck\Backup\Processor\ZipArchiveProcessor
     */
    public function create()
    {
        return new Processor(self::class);
    }
}
