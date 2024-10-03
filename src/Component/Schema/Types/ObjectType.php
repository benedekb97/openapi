<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema\Types;

use Benedekb\OpenAPI\Component\Exception\DuplicatePropertyException;
use Benedekb\OpenAPI\Component\Schema\SchemaInterface;

class ObjectType extends Type implements ObjectInterface
{
    private array $properties = [];

    private ?SchemaInterface $schema = null;

    public function integer(string $name): IntegerType
    {
        if (!array_key_exists($name, $this->properties)) {
            return $this->properties[$name] = new IntegerType($this);
        }

        throw new DuplicatePropertyException($name);
    }

    public function number(string $name): NumberType
    {
        if (!array_key_exists($name, $this->properties)) {
            return $this->properties[$name] = new NumberType($this);
        }

        throw new DuplicatePropertyException($name);
    }

    public function string(string $name): StringType
    {
        if (!array_key_exists($name, $this->properties)) {
            return $this->properties[$name] = new StringType($this);
        }

        throw new DuplicatePropertyException($name);
    }

    public function boolean(string $name): BooleanType
    {
        if (!array_key_exists($name, $this->properties)) {
            return $this->properties[$name] = new BooleanType($this);
        }

        throw new DuplicatePropertyException($name);
    }

    public function array(string $name): ArrayType
    {
        if (!array_key_exists($name, $this->properties)) {
            return $this->properties[$name] = new ArrayType($this);
        }

        throw new DuplicatePropertyException($name);
    }

    public function object(string $name): ObjectType
    {
        if (!array_key_exists($name, $this->properties)) {
            return $this->properties[$name] = new ObjectType($this);
        }

        throw new DuplicatePropertyException($name);
    }

    public function schema(SchemaInterface $schema): self
    {
        $this->schema = $schema;

        return $this;
    }

    public function getSchema(): ?SchemaInterface
    {
        return $this->schema;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }
}