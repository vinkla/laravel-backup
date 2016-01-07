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
 * This is the profile factory test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileFactoryTest extends AbstractTestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutName()
    {
        $factory = $this->getProfileFactory();

        $factory->make([
            'sources' => 'your-sources',
            'destinations' => 'your-destinations',
            'processor' => 'your-processor',
            'namer' => 'your-namer',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSources()
    {
        $factory = $this->getProfileFactory();

        $factory->make([
            'name' => 'your-name',
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
        $factory = $this->getProfileFactory();

        $factory->make([
            'name' => 'your-name',
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
        $factory = $this->getProfileFactory();

        $factory->make([
            'name' => 'your-name',
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
        $factory = $this->getProfileFactory();

        $factory->make([
            'name' => 'your-name',
            'sources' => 'your-sources',
            'destinations' => 'your-destinations',
            'processor' => 'your-processor',
        ]);
    }

    protected function getProfileFactory()
    {
        return new ProfileFactory();
    }
}
