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
use Vinkla\Backup\ProfileRegistryFactory;

/**
 * This is the profile registry factory test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileRegistryFactoryTest extends AbstractTestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutProfiles()
    {
        $factory = $this->getProfileRegistryFactory();

        $factory->make([]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSources()
    {
        $factory = $this->getProfileRegistryFactory();

        $factory->make([
            'profiles' => [
                [
                    'destinations' => 'your-destinations',
                    'processor' => 'your-processor',
                    'namer' => 'your-namer',
                ],
            ],
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutDestinations()
    {
        $factory = $this->getProfileRegistryFactory();

        $factory->make([
            'profiles' => [
                [
                    'sources' => 'your-sources',
                    'processor' => 'your-processor',
                    'namer' => 'your-namer',
                ],
            ],
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutProcessor()
    {
        $factory = $this->getProfileRegistryFactory();

        $factory->make([
            'profiles' => [
                [
                    'sources' => 'your-sources',
                    'destinations' => 'your-destinations',
                    'namer' => 'your-namer',
                ],
            ],
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutNamer()
    {
        $factory = $this->getProfileRegistryFactory();

        $factory->make([
            'profiles' => [
                [
                    'sources' => 'your-sources',
                    'destinations' => 'your-destinations',
                    'processor' => 'your-processor',
                ],
            ],
        ]);
    }

    protected function getProfileRegistryFactory()
    {
        $builder = new ProfileBuilderFactory($this->app);

        return new ProfileRegistryFactory($builder);
    }
}
