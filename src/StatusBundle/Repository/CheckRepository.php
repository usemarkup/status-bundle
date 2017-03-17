<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Repository;

use Markup\StatusBundle\Check\CheckInterface;
use Markup\StatusBundle\Registry\CheckRegistryInterface;

class CheckRepository implements CheckRepositoryInterface
{
    /**
     * @var CheckRegistryInterface
     */
    private $checkRegistry;

    public function __construct(CheckRegistryInterface $checkRegistry)
    {
        $this->checkRegistry = $checkRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function getByCheckName(string $name)/*: ?CheckInterface php7.1*/
    {
        if (!$this->checkRegistry->has($name)) {
            return null;
        }

        return $this->checkRegistry->get($name);
    }
}
