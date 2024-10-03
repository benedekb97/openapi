<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component;

use Benedekb\OpenAPI\Component\Enum\ParameterLocation;

readonly class Parameter
{
    public function __construct(
        private string $name,
        private ParameterLocation $location,
        private bool $required = true,
        private ?string $description = null,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocation(): ParameterLocation
    {
        return $this->location;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'in' => $this->location->value,
            'required' => $this->required,
            'description' => $this->description,
        ]);
    }
}