<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Backup;

/**
 * This is the factory interface.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
interface FactoryInterface
{
    /**
     * Bootstrap the factory.
     *
     * @return mixed
     */
    public function bootstrap();

    /**
     * Get the destination name.
     *
     * @return string
     */
    public function getName();
}
