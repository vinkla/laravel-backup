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
use Zenstruck\Backup\Processor\GzipArchiveProcessor;

/**
 * This is the gzip processor class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GzipProcessor implements FactoryInterface
{
    /**
     * Bootstrap the processor.
     *
     * @return \Zenstruck\Backup\Processor\GzipArchiveProcessor
     */
    public function bootstrap()
    {
        return new GzipArchiveProcessor($this->getName());
    }

    /**
     * Get the processor name.
     *
     * @return string
     */
    public function getName()
    {
        return 'gzip';
    }
}
