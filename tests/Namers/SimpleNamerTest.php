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

namespace Vinkla\Tests\Backup\Namers;

use Vinkla\Backup\Namers\SimpleNamer;
use Zenstruck\Backup\Namer\SimpleNamer as Namer;

/**
 * This is the simple namer test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class SimpleNamerTest extends AbstractNamerTestCase
{
    public function testBootstrap()
    {
        $this->assertInstanceOf(Namer::class, $this->getNamer()->bootstrap());
    }

    public function getNamer()
    {
        return new SimpleNamer();
    }
}
