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
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
    |
    */

    'profiles' => [

        'main' => [
            'sources' => ['database', 'uploads'],
            'destinations' => ['local'],
            'processor' => 'gzip',
            'namer' => 'timestamp',
        ],

        'alternative' => [
            'sources' => 'your-sources',
            'destinations' => 'your-destinations',
            'processor' => 'your-processor',
            'namer' => 'your-namer',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Backup Sources
    |--------------------------------------------------------------------------
    |
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
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
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
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
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
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
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
    |
    */

    'namers' => [
        'Vinkla\Backup\Namers\SimpleNamer',
        'Vinkla\Backup\Namers\TimestampNamer',
    ],

];
