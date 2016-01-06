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

/**
 * This is the profile builder factory test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileBuilderFactoryTest extends AbstractTestCase
{
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
