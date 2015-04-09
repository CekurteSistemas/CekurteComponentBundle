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
use Cekurte\ComponentBundle\Exception\ResourceNotFoundException;

/**
 * Class ResourceNotFoundExceptionTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResourceNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritedOfResourceException()
    {
        $exception = new ResourceNotFoundException();

        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\Exception\\ResourceException',
            $exception
        );
    }

    public function testGetCode()
    {
        $exception = new ResourceNotFoundException();

        $this->assertEquals(ResourceException::RESOURCE_NOTFOUND_ERROR_CODE, $exception->getCode());
    }
}
