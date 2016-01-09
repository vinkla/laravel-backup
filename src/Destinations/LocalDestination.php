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
use Zenstruck\Backup\Destination\StreamDestination;

/**
 * This is the local destination class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class LocalDestination implements FactoryInterface
{
    /**
     * Bootstrap the destination.
     *
     * @return \Zenstruck\Backup\Destination\StreamDestination
     */
    public function bootstrap()
    {
        return new StreamDestination($this->getName(), storage_path('backups'));
    }

    /**
     * Get the destination name.
     *
     * @return string
     */
    public function getName()
    {
        return 'local';
    }
}
