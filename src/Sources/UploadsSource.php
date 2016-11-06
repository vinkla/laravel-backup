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

use Zenstruck\Backup\Source\RsyncSource;

/**
 * This is the uploads source class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class UploadsSource implements SourceInterface
{
    /**
     * Bootstrap the source.
     *
     * @return \Zenstruck\Backup\Source\RsyncSource
     */
    public function bootstrap(): RsyncSource
    {
        return new RsyncSource($this->getName(), public_path('uploads'));
    }

    /**
     * Get the source name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'uploads';
    }
}
