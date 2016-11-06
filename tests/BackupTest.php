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

use Vinkla\Backup\Backup;
use Vinkla\Backup\ProfileBuilderFactory;
use Vinkla\Backup\ProfileRegistryFactory;
use Zenstruck\Backup\Executor;

/**
 * This is the backup test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class BackupTest extends AbstractTestCase
{
    public function testGetSet()
    {
        $backup = $this->getBackup();

        $this->assertSame('main', $backup->getProfile());

        $backup->setProfile('alternative');

        $this->assertSame('alternative', $backup->getProfile());
    }

    public function getBackup()
    {
        $builder = new ProfileBuilderFactory($this->app);
        $builder = $builder->make($this->app->config->get('backup'));

        $registry = new ProfileRegistryFactory($builder);
        $registry = $registry->make($this->app->config->get('backup'));

        $executor = new Executor($this->app->log);

        return new Backup($this->app->config, $registry, $executor);
    }
}
