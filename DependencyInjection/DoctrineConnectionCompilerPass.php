<?php

namespace Cekurte\ComponentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Doctrine Connection Compiler Pass
 */
class DoctrineConnectionCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $connection = $container
            ->getDefinition('doctrine.dbal.dynamic_connection')
            ->addMethodCall('setSession', array(new Reference('session'))
        );
    }
}
