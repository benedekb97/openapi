<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema;

use Benedekb\OpenAPI\Component\Schema\Types\ObjectInterface;

interface SchemaInterface extends ObjectInterface
{
    public function setUp(): void;

    public function getProperties(): array;
}