<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Resolver;

use Benedekb\OpenAPI\Component\Attribute\OpenApi;
use Benedekb\OpenAPI\Component\Enum\RequestMethod;
use Symfony\Component\Routing\Route;

class RouteOpenApiDefinitionResolver
{
    public function resolve(Route $route, RequestMethod $method): ?OpenApi
    {
        $controller = $route->getDefaults()['_controller'] ?? null;

        if (null === $controller) {
            return null;
        }

        [$controllerClass, $controllerMethod] = explode('::', $controller);

        if (null === $controllerClass || null === $controllerMethod) {
            return null;
        }

        $reflectionClass = new \ReflectionClass($controllerClass);

        $reflectionMethod = $reflectionClass->getMethod($controllerMethod);

        $attributes = $reflectionMethod->getAttributes(OpenApi::class);

        foreach ($attributes as $attribute) {
            /** @var OpenApi $instance */
            $instance = $attribute->newInstance();

            if ($instance->getMethod() === $method) {
                return $instance;
            }
        }

        return null;
    }
}