<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup\Namers;

use Vinkla\Backup\Namers\NamerInterface;
use Vinkla\Tests\Backup\AbstractTestCase;
use Vinkla\Tests\Backup\FactoryTrait;

/**
 * This is the abstract namer test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractNamerTestCase extends AbstractTestCase
{
    use FactoryTrait;

    public function getInterface()
    {
        return NamerInterface::class;
    }
}
