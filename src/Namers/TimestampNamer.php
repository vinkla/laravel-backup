<?php

namespace Vinkla\Backup\Namers;

use Zenstruck\Backup\Namer\TimestampNamer as Namer;

class TimestampNamer implements NamerInterface
{
    /**
     * Create and register the namer.
     *
     * @return mixed
     */
    public function create()
    {
        return new Namer(self::class);
    }
}
