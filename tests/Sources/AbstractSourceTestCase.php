<?php

/*
 * This file is part of Laravel Backup.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Backup\Sources;

use Vinkla\Backup\Sources\SourceInterface;
use Vinkla\Tests\Backup\AbstractTestCase;
use Vinkla\Tests\Backup\FactoryTrait;

/**
 * This is the abstract source test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractSourceTestCase extends AbstractTestCase
{
    use FactoryTrait;

    public function getInterface()
    {
        return SourceInterface::class;
    }
}
