<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema\Types;

use Benedekb\OpenAPI\Component\Schema\SchemaInterface;

class ArrayItems
{
    private ?Type $items = null;

    private ?SchemaInterface $schema = null;

    public function __construct(
        private ArrayType $array
    ) {}

    public function object(): ObjectType
    {
        return $this->items = new ObjectType($this->array);
    }

    public function array(): ArrayType
    {
        return $this->items = new ArrayType($this->array);
    }

    public function string(): StringType
    {
        return $this->items = new StringType($this->array);
    }

    public function integer(): IntegerType
    {
        return $this->items = new IntegerType($this->array);
    }

    public function number(): NumberType
    {
        return $this->items = new NumberType($this->array);
    }

    public function boolean(): BooleanType
    {
        return $this->items = new BooleanType($this->array);
    }

    public function schema(SchemaInterface $schema): ArrayType
    {
        $this->schema = $schema;

        return $this->array;
    }

    public function getItems(): ?Type
    {
        return $this->items;
    }

    public function getSchema(): ?SchemaInterface
    {
        return $this->schema;
    }
}