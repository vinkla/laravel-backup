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
    | Backup Sources
    |--------------------------------------------------------------------------
    |
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
    |
    */

    'sources' => [
        'Vinkla\Backup\Sources\RsyncSource',
        'Vinkla\Backup\Sources\MysqlDumpSource',
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
        'Vinkla\Backup\Destinations\StreamDestination',
    ],

    /*
    |--------------------------------------------------------------------------
    | Backup Processor
    |--------------------------------------------------------------------------
    |
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
    |
    */

    'processor' => 'Vinkla\Backup\Processors\GzipArchiveProcessor',

    /*
    |--------------------------------------------------------------------------
    | Backup Namer
    |--------------------------------------------------------------------------
    |
    | Pretty Mediocre photographic fake, they cut off your brother's hair.
    | Good morning, Mom. What's the meaning of this. Huh? Crazy drunk drivers.
    |
    */

    'namer' => 'Vinkla\Backup\Namers\TimestampNamer',

];
