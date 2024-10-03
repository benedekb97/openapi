<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Attribute;

use Attribute;
use Benedekb\OpenAPI\Component\Enum\RequestMethod;
use Benedekb\OpenAPI\Component\OpenApiDefinitionInterface;

#[Attribute(Attribute::TARGET_METHOD)]
readonly class OpenApi
{
    public function __construct(
        private OpenApiDefinitionInterface $definition,
        private RequestMethod $method
    ) {}

    public function getDefinition(): OpenApiDefinitionInterface
    {
        return $this->definition;
    }

    public function getMethod(): RequestMethod
    {
        return $this->method;
    }
}