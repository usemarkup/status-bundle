<?php

namespace Markup\StatusBundle;

use Markup\StatusBundle\DependencyInjection\Compiler\EnsureCheckServicesExistPass;
use Markup\StatusBundle\DependencyInjection\Compiler\SetTaggedCheckPass;
use Markup\StatusBundle\DependencyInjection\Compiler\SetTaggedGroupsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MarkupStatusBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SetTaggedGroupsPass());
        $container->addCompilerPass(new SetTaggedCheckPass());
        $container->addCompilerPass(new EnsureCheckServicesExistPass());
    }
}
