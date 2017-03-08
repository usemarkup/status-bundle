<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Registry;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

abstract class BaseContainerAwareRegistry implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @var array|string[]
     */
    protected $registry;

    public function __construct()
    {
        $this->registry = [];
    }

    /**
     * @param string $name
     * @param string $serviceId
     */
    public function add(string $name, string $serviceId): void
    {
        $this->registry[$name] = $serviceId;
    }

    /**
     * @return array|string[]
     */
    public function all()
    {
        return $this->registry;
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $name): bool
    {
        return isset($this->registry[$name]);
    }
}
