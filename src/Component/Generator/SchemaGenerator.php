<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Generator;

use Benedekb\OpenAPI\Component\Schema\SchemaInterface;

class SchemaGenerator
{
    private array $requiredSchemas = [];

    public function generate(SchemaInterface $schema): array
    {
        $schema->setUp();
    }
}