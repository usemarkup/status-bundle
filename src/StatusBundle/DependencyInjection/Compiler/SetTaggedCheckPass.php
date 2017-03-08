<?php

namespace Markup\StatusBundle\DependencyInjection\Compiler;

use Markup\StatusBundle\Check\CheckInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SetTaggedCheckPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $registry = $container->getDefinition('markup_status.registry.container_aware_check_registry');

        foreach ($container->findTaggedServiceIds('status.check') as $id => $tags) {
            if (!$container->hasDefinition($id)) {
                throw new \LogicException(
                    sprintf('References to the service %s, however it does not exist', $id)
                );
            }

            $check = $container->get($id);

            if (!$check instanceof CheckInterface) {
                throw new \LogicException(sprintf('Service %s referenced is not an instance of check', $id));
            }

            $name = $check->getName();

            $registry->addMethodCall('add', [$name, $id]);
        }
    }
}
