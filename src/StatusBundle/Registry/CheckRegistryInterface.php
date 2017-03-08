<?php

namespace Markup\StatusBundle\Registry;

use Markup\StatusBundle\Check\CheckInterface;

interface CheckRegistryInterface
{
    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * @param string $name
     * @return CheckInterface
     */
    public function get(string $name): CheckInterface;
}
