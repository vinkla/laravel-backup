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

/**
 * This is the namer interface.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
interface NamerInterface
{
    /**
     * Bootstrap the namer.
     *
     * @return \Zenstruck\Backup\Namer
     */
    public function bootstrap();

    /**
     * Get the namer name.
     *
     * @return string
     */
    public function getName();
}
