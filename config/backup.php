<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Backup Profile
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the profiles below you wish to use as
    | your default profile for backups.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Backup Profiles
    |--------------------------------------------------------------------------
    |
    | The profiles array allows you to setup multiple backup profiles. Example
    | configuration has been included, but you may add as many profiles as you
    | would like.
    |
    */

    'profiles' => [

        'main' => [
            'sources' => ['mysql', 'uploads'],
            'destinations' => ['local'],
            'processor' => 'gzip',
            'namer' => 'timestamp',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Backup Sources
    |--------------------------------------------------------------------------
    |
    | What to backup (i.e. database/files). The source fetches files and copies
    | them to a "scratch" directory. These files are typically persisted
    | between backups (improves rsync performance) but can be cleared by the
    | executor.
    |
    */

    'sources' => [
        Vinkla\Backup\Sources\MysqlDumpSource::class,
        Vinkla\Backup\Sources\UploadsSource::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Backup Destinations
    |--------------------------------------------------------------------------
    |
    | Where to send the backup i.e. filesystem, S3, Dropbox, etc. We have
    | provided a default local destination that will save the backup file
    | the Laravel's storage directory (storage/backups).
    |
    */

    'destinations' => [
        Vinkla\Backup\Destinations\LocalDestination::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Backup Processors
    |--------------------------------------------------------------------------
    |
    | The processors converts the backup to a single file (i.e. zip/tar.gz).
    | The processors use a namer to name the file (read more below).
    |
    */

    'processors' => [
        Vinkla\Backup\Processors\GzipProcessor::class,
        Vinkla\Backup\Processors\ZipProcessor::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Backup Namers
    |--------------------------------------------------------------------------
    |
    | Generates the backup filename to be used by the processors. Below we've
    | provided default namers. Of course, you may setup custom namers.
    |
    */

    'namers' => [
        Vinkla\Backup\Namers\SimpleNamer::class,
        Vinkla\Backup\Namers\TimestampNamer::class,
    ],

];
