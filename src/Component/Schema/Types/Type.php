<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema\Types;

use Benedekb\OpenAPI\Component\Exception\RootObjectException;

class Type
{
    public function __construct(
        protected ?Type $parent = null
    ) {}

    private bool $nullable = false;

    public function nullable(bool $nullable = true): self
    {
        $this->nullable = $nullable;

        return $this;
    }

    public function isNullable(): bool
    {
        return $this->nullable;
    }

    public function end(): Type
    {
        if (null === $this->parent) {
            throw new RootObjectException('Cannot call \'end\' on root object!');
        }

        return $this->parent;
    }
}