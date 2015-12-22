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

use Zenstruck\Backup\Processor\ZipArchiveProcessor as Processor;

class ZipArchiveProcessor implements ProcessorInterface
{
    /**
     * Create and register the processor.
     *
     * @return mixed
     */
    public function create()
    {
        return new Processor(self::class);
    }
}
