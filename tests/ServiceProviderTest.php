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
use Vinkla\Backup\BackupProfile;
use Vinkla\Backup\Commands\ListCommand;
use Vinkla\Backup\Commands\RunCommand;
use Vinkla\Backup\ProfileFactory;
use Vinkla\Backup\Sources\MysqlDumpSource;
use Zenstruck\Backup\Executor;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testBackupProfileIsInjectable()
    {
        $this->assertIsInjectable(BackupProfile::class);
    }

    public function testProfileFactoryIsInjectable()
    {
        $this->assertIsInjectable(ProfileFactory::class);
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
        $this->assertIsInjectable(MysqlDumpSource::class);
    }
}
