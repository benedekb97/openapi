<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema\Types;

use Benedekb\OpenAPI\Component\Schema\Enum\StringFormat;

class StringType extends Type
{
    private ?StringFormat $format = null;

    private ?string $example = null;

    public function format(StringFormat $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): ?StringFormat
    {
        return $this->format;
    }

    public function example(string $example): self
    {
        $this->example = $example;

        return $this;
    }

    public function getExample(): ?string
    {
        return $this->example;
    }
}