<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Registry;

use Markup\StatusBundle\Group\Group;

class ContainerAwareGroupRegistry extends BaseContainerAwareRegistry implements GroupRegistryInterface
{
    /**
     * {@inheritdoc}
     */
    public function get(string $name): Group
    {
        /** @var Group $group */
        $group = $this->container->get($this->registry[$name]);

        return $group;
    }
}
