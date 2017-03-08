<?php declare(strict_types = 1);

namespace Markup\StatusBundle\DependencyInjection;

use Markup\StatusBundle\Group\Group;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class MarkupStatusExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $this->addGroups($config, $container);
    }

    /**
     * @param array $config
     * @param ContainerBuilder $container
     */
    private function addGroups(array $config, ContainerBuilder $container)
    {
        $groups = $config['groups'];

        foreach ($groups as $groupName => $group) {
            $definition = new Definition(Group::class, [$groupName, $group['checks'], $group['options']]);
            $definition->addTag('status.group');

            $container->setDefinition(sprintf('markup_status.group.%s', $groupName), $definition);
        }
    }
}
