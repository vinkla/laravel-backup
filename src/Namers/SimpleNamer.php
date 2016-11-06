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

use Zenstruck\Backup\Namer\SimpleNamer as Namer;

/**
 * This is the simple namer class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class SimpleNamer implements NamerInterface
{
    /**
     * Bootstrap the namer.
     *
     * @return \Zenstruck\Backup\Namer\SimpleNamer
     */
    public function bootstrap(): Namer
    {
        return new Namer($this->getName());
    }

    /**
     * Get the namer name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'simple';
    }
}
