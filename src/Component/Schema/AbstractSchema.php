<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema;

use Benedekb\OpenAPI\Component\Schema\Types\ObjectType;

abstract class AbstractSchema extends ObjectType implements SchemaInterface
{
    private bool $setupComplete = false;

    abstract protected function build(): void;

    public function setUp(): void
    {
        if (!$this->setupComplete) {
            $this->build();

            $this->setupComplete = true;
        }
    }
}