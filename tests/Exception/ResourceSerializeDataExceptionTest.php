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

use Cekurte\ComponentBundle\Exception\ResourceSerializeDataException;
use Cekurte\ComponentBundle\Exception\ResourceException;

/**
 * Class ResourceSerializeDataExceptionTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResourceSerializeDataExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritedOfResourceException()
    {
        $exception = new ResourceSerializeDataException();

        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\Exception\\ResourceException',
            $exception
        );
    }

    public function testGetCode()
    {
        $exception = new ResourceSerializeDataException();

        $this->assertEquals(ResourceException::RESOURCE_SERIALIZE_DATA_ERROR_CODE, $exception->getCode());
    }
}
