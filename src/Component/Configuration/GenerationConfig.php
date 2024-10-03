<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Configuration;

readonly class GenerationConfig
{
    public function __construct(
        private array $skippedRoutes,
        private string $openApiVersion,
        private string $specificationVersion,
        private string $serviceName,
        private string $serviceDescription,
    ) {}

    public function getSkippedRoutes(): array
    {
        return $this->skippedRoutes;
    }

    public function getOpenApiVersion(): string
    {
        return $this->openApiVersion;
    }

    public function getSpecificationVersion(): string
    {
        return $this->specificationVersion;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function getServiceDescription(): string
    {
        return $this->serviceDescription;
    }

}