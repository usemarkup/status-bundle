<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Runner;

use Markup\StatusBundle\Collection\ResultCollection;
use Markup\StatusBundle\Group\Group;

interface RunnerInterface
{
    /**
     * @param Group $group
     * @return ResultCollection
     */
    public function run(Group $group): ResultCollection;
}
