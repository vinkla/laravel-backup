<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Backup\Namers;

use Zenstruck\Backup\Namer\TimestampNamer as Namer;

/**
 * This is timestamp namer class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class TimestampNamer implements NamerInterface
{
    /**
     * Bootstrap the namer.
     *
     * @return \Zenstruck\Backup\Namer\TimestampNamer
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
        return 'timestamp';
    }
}
