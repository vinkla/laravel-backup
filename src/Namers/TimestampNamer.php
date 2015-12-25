<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Backup\Namers;

use Vinkla\Backup\FactoryInterface;
use Zenstruck\Backup\Namer\TimestampNamer as Namer;

/**
 * This is timestamp namer class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class TimestampNamer implements FactoryInterface
{
    /**
     * Create and register the namer.
     *
     * @return \Zenstruck\Backup\Namer\TimestampNamer
     */
    public function create()
    {
        return new Namer(self::class);
    }
}
