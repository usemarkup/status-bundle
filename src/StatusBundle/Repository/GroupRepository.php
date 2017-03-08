<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Repository;

use Markup\StatusBundle\Group\Group;
use Markup\StatusBundle\Registry\GroupRegistryInterface;

class GroupRepository implements GroupRepositoryInterface
{
    /**
     * @var GroupRegistryInterface
     */
    private $groupRegistry;

    /**
     * @param GroupRegistryInterface $groupRegistry
     */
    public function __construct(GroupRegistryInterface $groupRegistry)
    {
        $this->groupRegistry = $groupRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function getByGroupName(string $name): ?Group
    {
        if (!$this->groupRegistry->has($name)) {
            return null;
        }

        return $this->groupRegistry->get($name);
    }
}
