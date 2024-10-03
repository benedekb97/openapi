<?php

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

return static function (DefinitionConfigurator $definition): void {
    $definition->rootNode()
        ->children()
            ->scalarNode('file_path')->defaultValue('contracts/openapi.json')->end()
            ->arrayNode('skipped_routes')->scalarPrototype()->end()
        ->end()
    ;
};