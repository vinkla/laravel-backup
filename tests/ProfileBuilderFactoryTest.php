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

use Vinkla\Backup\ProfileBuilderFactory;
use Zenstruck\Backup\ProfileBuilder;

/**
 * This is the profile builder factory test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileBuilderFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getProfileBuilderFactory();

        $return = $factory->make([
            'sources' => [
                'Vinkla\Backup\Sources\DatabaseSource',
                'Vinkla\Backup\Sources\UploadsSource',
            ],

            'destinations' => [
                'Vinkla\Backup\Destinations\LocalDestination',
            ],

            'processors' => [
                'Vinkla\Backup\Processors\GzipProcessor',
                'Vinkla\Backup\Processors\ZipProcessor',
            ],

            'namers' => [
                'Vinkla\Backup\Namers\SimpleNamer',
                'Vinkla\Backup\Namers\TimestampNamer',
            ],
        ]);

        $this->assertInstanceOf(ProfileBuilder::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSources()
    {
        $factory = $this->getProfileBuilderFactory();

        $factory->make([
            'destinations' => 'your-destinations',
            'processor' => 'your-processor',
            'namer' => 'your-namer',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutDestinations()
    {
        $factory = $this->getProfileBuilderFactory();

        $factory->make([
            'sources' => 'your-sources',
            'processor' => 'your-processor',
            'namer' => 'your-namer',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutProcessor()
    {
        $factory = $this->getProfileBuilderFactory();

        $factory->make([
            'sources' => 'your-sources',
            'destinations' => 'your-destinations',
            'namer' => 'your-namer',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutNamer()
    {
        $factory = $this->getProfileBuilderFactory();

        $factory->make([
            'sources' => 'your-sources',
            'destinations' => 'your-destinations',
            'processor' => 'your-processor',
        ]);
    }

    protected function getProfileBuilderFactory()
    {
        return new ProfileBuilderFactory($this->app);
    }
}
