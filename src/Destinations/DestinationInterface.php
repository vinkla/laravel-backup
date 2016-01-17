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

/**
 * This is the destination interface.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
interface DestinationInterface
{
    /**
     * Bootstrap the destination.
     *
     * @return \Zenstruck\Backup\Destination
     */
    public function bootstrap();

    /**
     * Get the destination name.
     *
     * @return string
     */
    public function getName();
}
