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

use Illuminate\Contracts\Config\Repository;
use ReflectionClass;
use Vinkla\Backup\Sources\DatabaseSource;
use Vinkla\Tests\Backup\AbstractFactoryTestCase;

/**
 * This is the mysql dump source test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class DatabaseSourceTest extends AbstractFactoryTestCase
{
    public function getFactory()
    {
        return new DatabaseSource($this->app->config);
    }

    public function testConfig()
    {
        $rc = new ReflectionClass($this->getFactory());
        $property = $rc->getProperty('config');
        $property->setAccessible(true);

        $config = $property->getValue($this->getFactory());

        $this->assertInstanceOf(Repository::class, $config);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBootstrapWithoutMysqlDriver()
    {
        $this->app->config->set('database.default', 'sqlite');

        $this->getFactory()->bootstrap();
    }
}
