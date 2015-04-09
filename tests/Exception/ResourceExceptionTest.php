<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Tests\Exception;

use Cekurte\ComponentBundle\Exception\ResourceException;

/**
 * Class ResourceExceptionTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResourceExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritedOfException()
    {
        $exception = new ResourceException();

        $this->assertInstanceOf(
            '\\Exception',
            $exception
        );
    }
}
