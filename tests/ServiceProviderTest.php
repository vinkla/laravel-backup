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
use Vinkla\Backup\Backup;
use Vinkla\Backup\Sources\DatabaseSource;
use Zenstruck\Backup\Executor;
use Zenstruck\Backup\ProfileBuilder;
use Zenstruck\Backup\ProfileRegistry;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testProfileRegistryIsInjectable()
    {
        $this->assertIsInjectable(ProfileRegistry::class);
    }

    public function testProfileBuilderIsInjectable()
    {
        $this->assertIsInjectable(ProfileBuilder::class);
    }

    public function testExecutorIsInjectable()
    {
        $this->assertIsInjectable(Executor::class);
    }

    public function testDatabaseSourceIsInjectable()
    {
        $this->assertIsInjectable(DatabaseSource::class);
    }

    public function testBackupIsInjectable()
    {
        $this->assertIsInjectable(Backup::class);
    }
}
