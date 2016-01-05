<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup;

use Vinkla\Backup\ProfileFactory;

/**
 * This is the profile registry test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileFactoryTest extends AbstractTestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSources()
    {
        $factory = $this->getProfileFactory();

        $factory->make([
            'destinations' => [
                'Vinkla\Backup\Destinations\StreamDestination',
            ],
            'processor' => '',
            'namer' => '',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutDestinations()
    {
        $factory = $this->getProfileFactory();

        $factory->make([
            'sources' => [
                'Vinkla\Backup\Sources\RsyncSource',
                'Vinkla\Backup\Sources\MysqlDumpSource',
            ],
            'processor' => '',
            'namer' => '',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutProcessor()
    {
        $factory = $this->getProfileFactory();

        $factory->make([
            'sources' => [
                'Vinkla\Backup\Sources\RsyncSource',
                'Vinkla\Backup\Sources\MysqlDumpSource',
            ],
            'destinations' => [
                'Vinkla\Backup\Destinations\StreamDestination',
            ],
            'namer' => '',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutNamer()
    {
        $factory = $this->getProfileFactory();

        $factory->make([
            'sources' => [
                'Vinkla\Backup\Sources\RsyncSource',
                'Vinkla\Backup\Sources\MysqlDumpSource',
            ],
            'destinations' => [
                'Vinkla\Backup\Destinations\StreamDestination',
            ],
            'processor' => '',
        ]);
    }

    protected function getProfileFactory()
    {
        return new ProfileFactory($this->app);
    }
}
