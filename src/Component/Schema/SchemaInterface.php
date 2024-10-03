<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema;

interface SchemaInterface
{
    public function setUp(): void;

    public function getProperties(): array;
}