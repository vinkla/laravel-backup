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

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Vinkla\Backup\Backup;
use Vinkla\Backup\BackupFactory;
use Vinkla\Backup\BackupManager;

/**
 * This is the backup manager test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class BackupManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('backup.default')->andReturn('backup');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Backup::class, $return);

        $this->assertArrayHasKey('backup', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(BackupFactory::class);

        $manager = new BackupManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('backup.connections')->andReturn(['backup' => $config]);

        $config['name'] = 'backup';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Backup::class));

        return $manager;
    }
}
