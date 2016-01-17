<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup\Commands;

use ReflectionClass;
use Vinkla\Backup\ProfileBuilderFactory;
use Vinkla\Backup\ProfileRegistryFactory;
use Vinkla\Tests\Backup\AbstractTestCase;
use Zenstruck\Backup\Executor;
use Zenstruck\Backup\ProfileRegistry;

/**
 * This is the abstract command test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractCommandTestCase extends AbstractTestCase
{
    public function testConfiguration()
    {
        $command = $this->getCommand();

        $this->assertNotNull($command->getName());
        $this->assertTrue(is_string($command->getName()));

        $this->assertNotNull($command->getDescription());
        $this->assertTrue(is_string($command->getDescription()));
    }

    public function testGetRegistry()
    {
        $rc = new ReflectionClass($this->getCommand());
        $method = $rc->getMethod('getRegistry');
        $method->setAccessible(true);

        $registry = $method->invokeArgs($this->getCommand(), []);

        $this->assertInstanceOf(ProfileRegistry::class, $registry);
    }

    abstract public function getCommand();

    public function getExecutor()
    {
        return new Executor($this->app['log']);
    }

    public function getRegistry()
    {
        $builder = new ProfileBuilderFactory($this->app);

        return new ProfileRegistryFactory($builder);
    }
}
