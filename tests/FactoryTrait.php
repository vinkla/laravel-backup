<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup;

/**
 * This is the factory trait.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
trait FactoryTrait
{
    public function testImplementsFactoryInterface()
    {
        $this->assertInstanceOf($this->getInterface(), $this->getFactory());
    }

    abstract public function getInterface();

    abstract public function getFactory();
}
