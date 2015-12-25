<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Backup\Destinations;

use Vinkla\Backup\FactoryInterface;
use Zenstruck\Backup\Destination\StreamDestination as Destination;

/**
 * This is the stream destination class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class StreamDestination implements FactoryInterface
{
    /**
     * Create and register the destination.
     *
     * @return \Zenstruck\Backup\Destination\StreamDestination
     */
    public function create()
    {
        return new Destination(self::class, storage_path('backups'));
    }
}
