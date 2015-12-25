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
use Zenstruck\Backup\Namer\SimpleNamer as Namer;

/**
 * This is the simple namer class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class SimpleNamer implements FactoryInterface
{
    /**
     * Create and register the namer.
     *
     * @return \Zenstruck\Backup\Namer\SimpleNamer
     */
    public function create()
    {
        return new Namer(self::class);
    }
}
