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

/**
 * This is the namer interface.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
interface NamerInterface
{
    /**
     * Create and register the namer.
     *
     * @return mixed
     */
    public function create();
}
