<?php

namespace Vinkla\Backup\Namers;

use Zenstruck\Backup\Namer\SimpleNamer as Namer;

class SimpleNamer implements NamerInterface
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
