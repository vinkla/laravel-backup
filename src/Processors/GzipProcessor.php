<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Backup\Processors;

use Zenstruck\Backup\Processor\GzipArchiveProcessor;

/**
 * This is the gzip processor class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GzipProcessor implements ProcessorInterface
{
    /**
     * Bootstrap the processor.
     *
     * @return \Zenstruck\Backup\Processor\GzipArchiveProcessor
     */
    public function bootstrap(): GzipArchiveProcessor
    {
        return new GzipArchiveProcessor($this->getName());
    }

    /**
     * Get the processor name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'gzip';
    }
}
