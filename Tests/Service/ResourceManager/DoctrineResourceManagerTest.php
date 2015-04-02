<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Tests\Service\ServiceManager;

use Cekurte\ComponentBundle\Service\ResourceManager\DoctrineResourceManager;

/**
 * Class DoctrineResourceManagerTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class DoctrineResourceManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetResourceClassName()
    {
        $entityManager = $this
            ->getMockBuilder('\Doctrine\ORM\EntityManagerInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $fakeEntity = 'CekurteComponentBundle\\FakeEntity';

        $doctrineResourceManager = new DoctrineResourceManager($entityManager, $fakeEntity);

        $this->assertEquals($fakeEntity, $doctrineResourceManager->getResourceClassName());
    }

    public function testGetResource()
    {
        $fakeEntity = 'CekurteComponentBundle\\FakeEntity';

        $entity = $this
            ->getMockBuilder($fakeEntity)
            ->setMethods(array('getNumber', 'getName'))
            ->getMock()
        ;

        $entity
            ->expects($this->once())
            ->method('getNumber')
            ->will($this->returnValue(1000))
        ;

        $entity
            ->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('Cercal'))
        ;

        $entityRepository = $this
            ->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $entityRepository
            ->expects($this->once())
            ->method('findOneBy')
            ->will($this->returnValue($entity))
        ;

        $entityManager = $this
            ->getMockBuilder('\Doctrine\ORM\EntityManagerInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $entityManager
            ->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($entityRepository))
        ;

        $doctrineResourceManager = new DoctrineResourceManager($entityManager, $fakeEntity);

        $resource = $doctrineResourceManager->getResource(array());

        $this->assertEquals(1000,     $resource->getNumber());
        $this->assertEquals('Cercal', $resource->getName());
    }
}
