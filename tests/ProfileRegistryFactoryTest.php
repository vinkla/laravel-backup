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

use Mockery;
use Vinkla\Backup\ProfileFactory;
use Vinkla\Backup\ProfileRegistryFactory;
use Zenstruck\Backup\ProfileRegistry;

/**
 * This is the profile registry factory test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ProfileRegistryFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getProfileRegistryFactory();

        $return = $factory->make(['profiles' => []]);

        $this->assertInstanceOf(ProfileRegistry::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutProfiles()
    {
        $factory = $this->getProfileRegistryFactory();

        $factory->make([]);
    }

    protected function getProfileRegistryFactory()
    {
        $factory = Mockery::mock(ProfileFactory::class);

        return new ProfileRegistryFactory($factory);
    }
}
