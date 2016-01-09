<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup\Sources;

use Vinkla\Backup\Sources\DatabaseSource;
use Vinkla\Tests\Backup\AbstractTestCase;
use Vinkla\Tests\Backup\FactoryTrait;

/**
 * This is the mysql dump source test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class DatabaseSourceTest extends AbstractTestCase
{
    use FactoryTrait;

    public function getFactory()
    {
        return new DatabaseSource($this->app->config);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWithoutMysqlDriver()
    {
        $this->app->config->set('database.driver', 'sqlite');

        $this->getFactory()->bootstrap();
    }
}
