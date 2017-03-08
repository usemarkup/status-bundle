<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Repository;

use Markup\StatusBundle\Check\CheckInterface;

interface CheckRepositoryInterface
{
    /**
     * @param string $name
     * @return CheckInterface|null
     */
    public function getByCheckName(string $name): ?CheckInterface;
}
