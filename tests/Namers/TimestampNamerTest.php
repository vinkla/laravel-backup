<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup\Destinations;

use Vinkla\Backup\Namers\TimestampNamer;
use Vinkla\Tests\Backup\AbstractFactoryTestCase;

/**
 * This is the timestamp namer test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class TimestampNamerTest extends AbstractFactoryTestCase
{
    public function getFactory()
    {
        return new TimestampNamer();
    }
}
