<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Generator;

use Benedekb\OpenAPI\Component\Enum\ParameterLocation;
use Benedekb\OpenAPI\Component\Enum\RequestMethod;
use Benedekb\OpenAPI\Component\Parameter;
use Benedekb\OpenAPI\Component\Resolver\ParameterResolver;
use Benedekb\OpenAPI\Component\Resolver\RouteOpenApiDefinitionResolver;
use Symfony\Component\Routing\Route;

readonly class PathGenerator
{
    public function __construct(
        private RouteOpenApiDefinitionResolver $routeOpenApiDefinitionResolver,
        private OperationGenerator $operationGenerator,
        private ParameterResolver $parameterResolver,
    ) {}

    public function generate(Route $route): array
    {
        $pathData = [];

        foreach (RequestMethod::cases() as $requestMethod) {
            if (!in_array(strtoupper($requestMethod->value), $route->getMethods())) {
                continue;
            }

            $openApi = $this->routeOpenApiDefinitionResolver->resolve($route, $requestMethod);

            if (null === $openApi) {
                continue;
            }

            $pathData[$requestMethod->value] = $this->operationGenerator->generate($openApi->getDefinition());
        }

        if (isset($openApi)) {
            $parameters = $this->parameterResolver->resolve($openApi->getDefinition(), ParameterLocation::PATH);

            $parameters = array_map(
                static function (Parameter $parameter): array
                {
                    return $parameter->toArray();
                },
                $parameters
            );

            if (!empty($parameters)) {
                $pathData['parameters'] = $parameters;
            }
        }

        return array_filter($pathData);
    }
}