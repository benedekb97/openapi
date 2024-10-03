<?php

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

return static function (DefinitionConfigurator $definition): void {
    $definition->rootNode()
        ->children()
            ->scalarNode('file_path')->defaultValue('contracts/openapi.json')->end()
            ->scalarNode('skipped_routes')->defaultValue(['/_error/'])->end()
            ->scalarNode('oas_version')->defaultValue('3.1.0')->end()
            ->scalarNode('version')->defaultValue('0.0.1')->end()
            ->scalarNode('name')->defaultValue('Service')->end()
            ->scalarNode('description')->defaultValue('Service description')->end()
        ->end()
    ;
};