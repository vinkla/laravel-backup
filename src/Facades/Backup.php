<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Backup\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the backup facade class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Backup extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'backup';
    }
}
