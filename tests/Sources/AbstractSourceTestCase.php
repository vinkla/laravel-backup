<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\Backup\Sources;

use Vinkla\Backup\Sources\SourceInterface;
use Vinkla\Tests\Backup\AbstractTestCase;

/**
 * This is the abstract namer test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractSourceTestCase extends AbstractTestCase
{
    public function testImplementsSourceInterface()
    {
        $this->assertInstanceOf(SourceInterface::class, $this->getSource());
    }

    public function testNameIsString()
    {
        $this->assertTrue(is_string($this->getSource()->getName()));
    }

    abstract public function getSource();
}
