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

use Zenstruck\Backup\Destination\StreamDestination as Destination;

/**
 * This is the stream destination class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class StreamDestination implements DestinationInterface
{
    /**
     * Create and register the destination.
     *
     * @param array $config
     *
     * @return mixed
     */
    public function create(array $config)
    {
        return new Destination('stream', storage_path('backups'));
    }
}
