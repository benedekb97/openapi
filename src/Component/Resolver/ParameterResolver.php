<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Resolver;

use Benedekb\OpenAPI\Component\Enum\ParameterLocation;
use Benedekb\OpenAPI\Component\OpenApiDefinitionInterface;
use Benedekb\OpenAPI\Component\Parameter;

class ParameterResolver
{
    public function resolve(OpenApiDefinitionInterface $definition, ParameterLocation $location): array
    {
        return array_filter(
            $definition->getParameters(),
            static function (Parameter $parameter) use ($location): bool {
                return $location === $parameter->getLocation();
            }
        );
    }
}