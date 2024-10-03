<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component;

use Benedekb\OpenAPI\Component\Schema\SchemaInterface;

interface RequestBodyInterface extends SchemaInterface
{
    public function getDescription(): ?string;

    public function isRequired(): bool;
}