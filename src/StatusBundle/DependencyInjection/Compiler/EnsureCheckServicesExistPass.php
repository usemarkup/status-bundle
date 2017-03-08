<?php

namespace Markup\StatusBundle\DependencyInjection\Compiler;

use Markup\StatusBundle\Group\Group;
use Markup\StatusBundle\Repository\CheckRepositoryInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class EnsureCheckServicesExistPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $groupRegistry = $container->get('markup_status.registry.container_aware_group_registry');

        /** @var CheckRepositoryInterface $checkRepository */
        $checkRepository = $container->get('markup_status.repository.check_repository');

        foreach ($groupRegistry->all() as $group) {
            /** @var Group $group */
            $group = $container->get($group);

            $checks = $group->getChecks();

            foreach ($checks as $check) {
                if ($checkRepository->getByCheckName($check) === null) {
                    throw new \LogicException(
                        sprintf('Check %s could not be found, therefore you can not use it', $check)
                    );
                }
            }
        }
    }
}
