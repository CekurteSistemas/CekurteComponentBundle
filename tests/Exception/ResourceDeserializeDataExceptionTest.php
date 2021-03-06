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

use Cekurte\ComponentBundle\Exception\ResourceDeserializeDataException;
use Cekurte\ComponentBundle\Exception\ResourceException;

/**
 * Class ResourceDeserializeDataExceptionTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResourceDeserializeDataExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritedOfResourceException()
    {
        $exception = new ResourceDeserializeDataException();

        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\Exception\\ResourceException',
            $exception
        );
    }

    public function testGetCode()
    {
        $exception = new ResourceDeserializeDataException();

        $this->assertEquals(ResourceException::RESOURCE_DESERIALIZE_DATA_ERROR_CODE, $exception->getCode());
    }
}
