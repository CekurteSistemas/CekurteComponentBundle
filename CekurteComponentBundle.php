<?php

namespace Cekurte\ComponentBundle;

use Cekurte\ComponentBundle\DependencyInjection\DoctrineConnectionCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CekurteComponentBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DoctrineConnectionCompilerPass());
    }
}
