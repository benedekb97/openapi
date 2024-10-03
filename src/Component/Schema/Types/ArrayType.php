<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema\Types;

class ArrayType extends Type
{
    private ?ArrayItems $items = null;

    public function items(): ArrayItems
    {
        return $this->items = new ArrayItems($this);
    }

    public function getItems(): ?ArrayItems
    {
        return $this->items;
    }
}