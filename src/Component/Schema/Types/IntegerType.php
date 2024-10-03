<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema\Types;

use Benedekb\OpenAPI\Component\Schema\Enum\IntegerFormat;

class IntegerType extends Type
{
    private ?IntegerFormat $format = null;

    private ?int $example = null;

    public function format(IntegerFormat $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): ?IntegerFormat
    {
        return $this->format;
    }

    public function example(int $example): self
    {
        $this->example = $example;

        return $this;
    }

    public function getExample(): ?int
    {
        return $this->example;
    }
}