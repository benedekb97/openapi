<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Generator;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouterInterface;

readonly class OpenApiGenerator
{
    public function __construct(
        private RouterInterface $router,
        private array $skippedRoutes
    ) {}

    public function generate(): array
    {
        foreach ($this->router->getRouteCollection() as $route) {
            if ($this->shouldSkipRoute($route)) {
                continue;
            }

            dump($route);
        }

        return [];
    }

    private function shouldSkipRoute(Route $route): bool
    {
        foreach ($this->skippedRoutes as $routePrefix) {
            if (str_starts_with($route->getPath(), $routePrefix) || $route->getPath() === $routePrefix) {
                return true;
            }
        }

        return false;
    }
}