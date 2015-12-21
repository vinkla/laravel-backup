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

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Vinkla\Backup\BackupManager;
use Vinkla\Backup\Facades\Backup;

/**
 * This is the backup facade test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class BackupTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'backup';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Backup::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return BackupManager::class;
    }
}
