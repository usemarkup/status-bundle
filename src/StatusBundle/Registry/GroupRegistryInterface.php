<?php

namespace Markup\StatusBundle\Registry;

use Markup\StatusBundle\Group\Group;

interface GroupRegistryInterface
{
    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * @param string $name
     * @return Group
     */
    public function get(string $name): Group;
}
