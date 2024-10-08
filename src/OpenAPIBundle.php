<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class OpenAPIBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->import(__DIR__ . '/../config/openapi.php');
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->parameters()
            ->set('openapi.file_path', $config['file_path'])
            ->set('openapi.skipped_routes', $config['skipped_routes'])
            ->set('openapi.oas_version', $config['oas_version'])
            ->set('openapi.version', $config['version'])
            ->set('openapi.name', $config['name'])
            ->set('openapi.description', $config['description']);

        $container->import(__DIR__ . '/../config/services.yaml');
    }
}