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
use Zenstruck\Backup\Source\MySqlDumpSource;

/**
 * This is the mysql dump source test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class DatabaseSourceTest extends AbstractSourceTestCase
{
    public function testBootstrap()
    {
        $this->assertInstanceOf(MySqlDumpSource::class, $this->getSource()->bootstrap());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBootstrapWithoutMysqlDriver()
    {
        $this->app->config->set('database.default', 'sqlite');

        $this->getSource()->bootstrap();
    }

    public function testConfig()
    {
        $rc = new ReflectionClass($this->getSource());
        $property = $rc->getProperty('config');
        $property->setAccessible(true);

        $config = $property->getValue($this->getSource());

        $this->assertInstanceOf(Repository::class, $config);
    }

    public function getSource()
    {
        return new DatabaseSource($this->app->config);
    }
}
