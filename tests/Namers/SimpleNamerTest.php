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

use Vinkla\Backup\Namers\SimpleNamer;
use Vinkla\Tests\Backup\AbstractFactoryTestCase;

/**
 * This is the simple namer test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class SimpleNamerTest extends AbstractFactoryTestCase
{
    public function getFactory()
    {
        return new SimpleNamer();
    }
}
