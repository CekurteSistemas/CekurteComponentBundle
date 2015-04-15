<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Tests;

/**
 * Class CekurteComponentBundleTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class CekurteComponentBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritedOfBundle()
    {
        $reflection = new \ReflectionClass('\\Cekurte\\ComponentBundle\\CekurteComponentBundle');

        $this->assertTrue($reflection->isSubclassOf(
            '\\Symfony\\Component\\HttpKernel\\Bundle\\Bundle'
        ));
    }
}
