<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Generator;

use Benedekb\OpenAPI\Component\Configuration\GenerationConfig;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouterInterface;

readonly class OpenApiGenerator
{
    public function __construct(
        private RouterInterface $router,
        private GenerationConfig $config,
        private PathGenerator $pathGenerator,
    ) {}

    public function generate(): array
    {
        $paths = [];

        foreach ($this->router->getRouteCollection() as $route) {
            if ($this->shouldSkipRoute($route)) {
                continue;
            }

            $pathData = $this->pathGenerator->generate($route);

            if (!empty($pathData)) {
                $paths[$route->getPath()] = $this->pathGenerator->generate($route);
            }
        }


        return [
            'openapi' => $this->config->getOpenApiVersion(),
            'info' => [
                'title' => $this->config->getServiceName(),
                'description' => $this->config->getServiceDescription(),
                'version' => $this->config->getSpecificationVersion()
            ],
            'paths' => $paths,
        ];
    }

    private function shouldSkipRoute(Route $route): bool
    {
        foreach ($this->config->getSkippedRoutes() as $routePrefix) {
            if (str_starts_with($route->getPath(), $routePrefix) || $route->getPath() === $routePrefix) {
                return true;
            }
        }

        return false;
    }
}