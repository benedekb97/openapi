<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('openapi');

        $treeBuilder
            ->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('file_path')
                    ->info('The output path for openapi.json')
                    ->defaultValue('contracts/openapi.json')
                ->end()
            ->end()
        ->end();


        return $treeBuilder;
    }
}