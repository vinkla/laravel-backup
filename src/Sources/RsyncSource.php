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

use Illuminate\Filesystem\Filesystem;
use Zenstruck\Backup\Source\RsyncSource as Source;

/**
 * This is the rsync source class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RsyncSource implements SourceInterface
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * Create a new rsync source.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Create and register the source.
     *
     * @return \Zenstruck\Backup\Source\RsyncSource
     */
    public function create()
    {
        $excludes = '';

        if ($this->filesystem->exists(base_path('.gitignore'))) {
            $ignore = $this->filesystem->get(base_path('.gitignore'));

            $excludes = implode(' ', explode("\n", $ignore));
        }

        dd($excludes);

        return new Source(self::class, base_path(), ['--exclude' => $excludes]);
    }
}
