<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component;

use Benedekb\OpenAPI\Component\Schema\SchemaInterface;

interface ResponseInterface extends SchemaInterface
{
    public function getStatusCode(): int;

    public function getDescription(): ?string;
}