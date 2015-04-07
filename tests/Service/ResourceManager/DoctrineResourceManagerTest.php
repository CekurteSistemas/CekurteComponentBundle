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
    /**
     * @return string
     */
    private function getFakeEntityName()
    {
        return '\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\ResourceInterface';
    }

    /**
     * @param  string $entityName
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockEntity($entityName = '')
    {
        $entity = $this
            ->getMockBuilder($this->getFakeEntityName())
            ->setMethods(array('getNumber', 'getName'))
            ->getMock()
        ;

        $entity
            ->expects($this->any())
            ->method('getNumber')
            ->will($this->returnValue(1000))
        ;

        $entity
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('Cercal'))
        ;

        return $entity;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockEntityRepository()
    {
        $mockBuilder = $this
            ->getMockBuilder('\\Doctrine\\Common\\Persistence\\ObjectRepository')
            ->setMethods(array('find', 'findAll', 'findBy', 'findOneBy', 'getClassName', 'getLogEntries'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return $mockBuilder;
    }

    /**
     * @param  \PHPUnit_Framework_MockObject_MockObject|null $mockEntityRepository
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockEntityManager(\PHPUnit_Framework_MockObject_MockObject $mockEntityRepository = null)
    {
        $entityManager = $this
            ->getMockBuilder('\\Doctrine\\ORM\\EntityManagerInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $entityManager
            ->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockEntityRepository))
        ;

        return $entityManager;
    }

    /**
     * @param  \PHPUnit_Framework_MockObject_MockObject $mockEntityManager
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockContainer(\PHPUnit_Framework_MockObject_MockObject $mockEntityManager)
    {
        $container = $this
            ->getMockBuilder('\\Symfony\\Component\\DependencyInjection\\Container')
            ->setMethods(array('has', 'get', 'setContainer'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $container
            ->expects($this->any())
            ->method('has')
            ->withAnyParameters()
            ->will($this->returnValue(true))
        ;

        $doctrine = $this
            ->getMockBuilder('\\Doctrine\\Bundle\\DoctrineBundle\\Registry')
            ->setMethods(array('getManager'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $doctrine
            ->expects($this->any())
            ->method('getManager')
            ->will($this->returnValue($mockEntityManager))
        ;

        $container
            ->expects($this->any())
            ->method('get')
            ->with($this->equalTo('doctrine'))
            ->will($this->returnValue($doctrine))
        ;

        return $container;
    }

    public function testClassIsAbstract()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager'
        );

        $this->assertTrue($reflection->isAbstract());
    }

    public function testInstanceOfResourceManagerInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\ComponentBundle\\Service\\ResourceManagerInterface'
        ));
    }

    public function testGetResourceClassName()
    {
        $mockEntityManager = $this->getMockEntityManager();

        $mockContainer     = $this->getMockContainer($mockEntityManager);

        $doctrineResourceManager = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager')
            ->setConstructorArgs(array(
                $mockContainer,
                $this->getFakeEntityName()
            ))
            ->getMockForAbstractClass()
        ;

        $this->assertEquals($this->getFakeEntityName(), $doctrineResourceManager->getResourceClassName());
    }

    public function testFindResource()
    {
        $mockEntity           = $this->getMockEntity();

        $mockEntityRepository = $this->getMockEntityRepository();

        $mockEntityRepository
            ->expects($this->once())
            ->method('findOneBy')
            ->will($this->returnValue($mockEntity))
        ;

        $mockEntityManager = $this->getMockEntityManager($mockEntityRepository);

        $mockContainer     = $this->getMockContainer($mockEntityManager);

        $doctrineResourceManager = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager')
            ->setConstructorArgs(array(
                $mockContainer,
                $this->getFakeEntityName()
            ))
            ->getMockForAbstractClass()
        ;

        $resource = $doctrineResourceManager->findResource(array());

        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\ResourceInterface',
            $resource
        );

        $this->assertEquals(1000,     $resource->getNumber());
        $this->assertEquals('Cercal', $resource->getName());
    }

    public function testGetLogEntriesAsEmpty()
    {
        $mockEntity           = $this->getMockEntity();

        $mockEntityRepository = $this->getMockEntityRepository();

        $mockEntityRepository
            ->expects($this->once())
            ->method('findOneBy')
            ->will($this->returnValue($mockEntity))
        ;

        $mockEntityRepository
            ->expects($this->once())
            ->method('getLogEntries')
            ->will($this->returnValue(array()))
        ;

        $mockEntityManager = $this->getMockEntityManager($mockEntityRepository);

        $mockContainer     = $this->getMockContainer($mockEntityManager);

        $doctrineResourceManager = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager')
            ->setConstructorArgs(array(
                $mockContainer,
                $this->getFakeEntityName()
            ))
            ->getMockForAbstractClass()
        ;

        $resource = $doctrineResourceManager->findResource(array());

        $entries = $doctrineResourceManager->getLogEntries($resource);

        $this->assertEmpty($entries);
    }

    public function testFindResources()
    {
        $mockEntity           = $this->getMockEntity();

        $mockEntityRepository = $this->getMockEntityRepository();

        $mockEntityRepository
            ->expects($this->once())
            ->method('findBy')
            ->will($this->returnValue(array($mockEntity, $mockEntity, $mockEntity)))
        ;

        $mockEntityManager = $this->getMockEntityManager($mockEntityRepository);

        $mockContainer     = $this->getMockContainer($mockEntityManager);

        $doctrineResourceManager = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager')
            ->setConstructorArgs(array(
                $mockContainer,
                $this->getFakeEntityName()
            ))
            ->getMockForAbstractClass()
        ;

        $resources = $doctrineResourceManager->findResources();

        $this->assertEquals(1000,     $resources[0]->getNumber());
        $this->assertEquals('Cercal', $resources[0]->getName());

        $this->assertEquals(3, count($resources));
    }

    public function testWriteResource()
    {
        $mockEntity        = $this->getMockEntity();

        $mockEntityManager = $this->getMockEntityManager();

        $mockContainer     = $this->getMockContainer($mockEntityManager);

        $doctrineResourceManager = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager')
            ->setConstructorArgs(array(
                $mockContainer,
                $this->getFakeEntityName()
            ))
            ->getMockForAbstractClass()
        ;

        $result = $doctrineResourceManager->writeResource($mockEntity);

        $this->assertTrue($result);
    }

    public function testUpdateResource()
    {
        $mockEntity        = $this->getMockEntity();

        $mockEntityManager = $this->getMockEntityManager();

        $mockContainer     = $this->getMockContainer($mockEntityManager);

        $doctrineResourceManager = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager')
            ->setConstructorArgs(array(
                $mockContainer,
                $this->getFakeEntityName()
            ))
            ->getMockForAbstractClass()
        ;

        $result = $doctrineResourceManager->updateResource($mockEntity);

        $this->assertTrue($result);
    }

    public function testDeleteResource()
    {
        $mockEntity        = $this->getMockEntity();

        $mockEntityManager = $this->getMockEntityManager();

        $mockContainer     = $this->getMockContainer($mockEntityManager);

        $doctrineResourceManager = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager')
            ->setConstructorArgs(array(
                $mockContainer,
                $this->getFakeEntityName()
            ))
            ->getMockForAbstractClass()
        ;

        $result = $doctrineResourceManager->deleteResource($mockEntity);

        $this->assertTrue($result);
    }
}
