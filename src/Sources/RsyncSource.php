<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Backup\Sources;

use Vinkla\Backup\FactoryInterface;
use Zenstruck\Backup\Source\RsyncSource as Source;

/**
 * This is the rsync source class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RsyncSource implements FactoryInterface
{
    /**
     * Create and register the source.
     *
     * @return \Zenstruck\Backup\Source\RsyncSource
     */
    public function create()
    {
        return new Source(self::class, $this->getSourcePath());
    }

    /**
     * Get the source path.
     *
     * @return string
     */
    public function getSourcePath()
    {
        return public_path();
    }
}
