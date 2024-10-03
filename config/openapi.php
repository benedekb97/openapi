<?php

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

return static function (DefinitionConfigurator $definition): void {
    $definition->rootNode()
        ->children()
            ->scalarNode('file_path')->defaultValue('contracts/openapi.json')->end()
            ->scalarNode('skipped_routes')->defaultValue(['/_error/'])->end()
        ->end()
    ;
};