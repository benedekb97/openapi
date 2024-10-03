<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Generator;

use Symfony\Component\Routing\RouterInterface;

readonly class OpenApiGenerator
{
    public function __construct(
        private RouterInterface $router
    ) {}

    public function generate(): array
    {
        foreach ($this->router->getRouteCollection() as $route) {
            dd ($route);
        }
    }
}