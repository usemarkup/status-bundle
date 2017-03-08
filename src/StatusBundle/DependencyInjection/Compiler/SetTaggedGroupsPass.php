<?php

namespace Markup\StatusBundle\DependencyInjection\Compiler;

use Markup\StatusBundle\Group\Group;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SetTaggedGroupsPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $registry = $container->getDefinition('markup_status.registry.container_aware_group_registry');

        foreach ($container->findTaggedServiceIds('status.group') as $id => $tags) {
            if (!$container->hasDefinition($id)) {
                throw new \LogicException(
                    sprintf('References to the service %s, however it does not exist', $id)
                );
            }

            $group = $container->get($id);

            if (!$group instanceof Group) {
                throw new \LogicException(sprintf('Service %s referenced is not an instance of group', $id));
            }

            $name = $group->getName();

            $registry->addMethodCall('add', [$name, $id]);
        }
    }
}
