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

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Vinkla\Backup\Commands\ListCommand;
use Vinkla\Backup\Commands\RunCommand;
use Vinkla\Backup\ProfileRegistryFactory;
use Vinkla\Backup\Sources\MySqlDumpSource;
use Zenstruck\Backup\Executor;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testProfileRegistryFactoryIsInjectable()
    {
        $this->assertIsInjectable(ProfileRegistryFactory::class);
    }

    public function testExecutorIsInjectable()
    {
        $this->assertIsInjectable(Executor::class);
    }

    public function testListCommandIsInjectable()
    {
        $this->assertIsInjectable(ListCommand::class);
    }

    public function testRunCommandIsInjectable()
    {
        $this->assertIsInjectable(RunCommand::class);
    }
    
    public function testMySqlDumpSourceIsInjectable()
    {
        $this->assertIsInjectable(MySqlDumpSource::class);
    }
}
