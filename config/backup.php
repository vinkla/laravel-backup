<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

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
            'sources' => ['database', 'uploads'],
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
        'Vinkla\Backup\Sources\DatabaseSource',
        'Vinkla\Backup\Sources\UploadsSource',
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
        'Vinkla\Backup\Destinations\LocalDestination',
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
        'Vinkla\Backup\Processors\GzipProcessor',
        'Vinkla\Backup\Processors\ZipProcessor',
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
        'Vinkla\Backup\Namers\SimpleNamer',
        'Vinkla\Backup\Namers\TimestampNamer',
    ],

];
