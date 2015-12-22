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

use Zenstruck\Backup\Source\RsyncSource as Source;

/**
 * This is the rsync source class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RsyncSource implements SourceInterface
{
    /**
     * Create and register the source.
     *
     * @return \Zenstruck\Backup\Source\RsyncSourc
     */
    public function create()
    {
        $excludes = implode(' ', [
            base_path('vendor'),
            base_path('node_modules'),
        ]);

        return new Source(self::class, base_path(), ['--exclude' => $excludes]);
    }
}
