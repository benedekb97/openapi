<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema\Types;

use Benedekb\OpenAPI\Component\Schema\Enum\NumberFormat;

class NumberType extends Type
{
    private ?NumberFormat $format = null;

    private ?float $example = null;

    public function format(NumberFormat $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): ?NumberFormat
    {
        return $this->format;
    }

    public function example(?float $example): self
    {
        $this->example = $example;

        return $this;
    }

    public function getExample(): ?float
    {
        return $this->example;
    }
}