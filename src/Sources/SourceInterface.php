<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Backup\Sources;

/**
 * This is the source interface.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
interface SourceInterface
{
    /**
     * Create and register the source.
     *
     * @return mixed
     */
    public function create();
}
