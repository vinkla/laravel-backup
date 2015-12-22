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
    | Default Profile
    |--------------------------------------------------------------------------
    |
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Backup Profiles
    |--------------------------------------------------------------------------
    |
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
    |
    */

    'profiles' => [

        'main' => [
            'sources' => [
                'Vinkla\Backup\Sources\RsyncSource',
                'Vinkla\Backup\Sources\MySqlDumpSource',
            ],
            'destinations' => [
                'Vinkla\Backup\Destinations\StreamDestination',
            ],
        ],

        'alternative' => [
            'sources' => ['your-sources-array'],
            'destinations' => ['your-sources-array'],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Backup Processors
    |--------------------------------------------------------------------------
    |
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
    |
    */

    'processors' => [
        'Vinkla\Backup\Processors\GzipArchiveProcessor',
        'Vinkla\Backup\Processors\ZipArchiveProcessor',
    ],

    /*
    |--------------------------------------------------------------------------
    | Backup Namers
    |--------------------------------------------------------------------------
    |
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
    |
    */

    'namers' => [
        'Vinkla\Backup\Namers\TimestampNamer',
        'Vinkla\Backup\Namers\SimpleNamer',
    ],

];
