<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component;

interface OpenApiDefinitionInterface
{
    public function getResponses(): array;

    public function getRequestBody(): ?RequestBodyInterface;

    public function getParameters(): array;

    public function getTags(): array;

    public function getSummary(): ?string;

    public function getDescription(): ?string;

    public function getOperationId(): ?string;
}