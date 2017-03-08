<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Registry;

use Markup\StatusBundle\Check\CheckInterface;

class ContainerAwareCheckRegistry extends BaseContainerAwareRegistry implements CheckRegistryInterface
{
    /**
     * {@inheritdoc}
     */
    public function get(string $name): CheckInterface
    {
        /** @var CheckInterface $check */
        $check = $this->container->get($this->registry[$name]);

        return $check;
    }
}
