<?php

namespace Fosvn\Bundle\FactoryBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fosvn_factory');

        $rootNode
            ->children()
                ->arrayNode('entities')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('connection')
                                ->defaultValue('doctrine')
                            ->end()
                            ->scalarNode('entity_class')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->scalarNode('manager_class')
                                ->defaultNull()
                            ->end()
                            ->arrayNode('form')
                                ->children()
                                    ->scalarNode('class')
                                        ->defaultNull()
                                    ->end()
                                    ->scalarNode('filter_class')
                                        ->defaultNull()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
