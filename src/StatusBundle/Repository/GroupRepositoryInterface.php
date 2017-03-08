<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Repository;

use Markup\StatusBundle\Group\Group;

interface GroupRepositoryInterface
{
    /**
     * @param string $name
     * @return Group
     */
    public function getByGroupName(string $name): ?Group;
}
