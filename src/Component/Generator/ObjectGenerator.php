<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Generator;

use Benedekb\OpenAPI\Component\Exception\ArrayItemsEmptyException;
use Benedekb\OpenAPI\Component\Schema\SchemaInterface;
use Benedekb\OpenAPI\Component\Schema\Types\ArrayType;
use Benedekb\OpenAPI\Component\Schema\Types\BooleanType;
use Benedekb\OpenAPI\Component\Schema\Types\IntegerType;
use Benedekb\OpenAPI\Component\Schema\Types\NumberType;
use Benedekb\OpenAPI\Component\Schema\Types\ObjectInterface;
use Benedekb\OpenAPI\Component\Schema\Types\ObjectType;
use Benedekb\OpenAPI\Component\Schema\Types\StringType;
use Benedekb\OpenAPI\Component\Schema\Types\Type;
use ReflectionClass;

class ObjectGenerator
{
    private array $requiredSchemas = [];

    public function generate(ObjectInterface $object): array
    {
        $object->setUp();

        if (null !== $object->getSchema()) {
            $schemaName = (new ReflectionClass($object->getSchema()))->getShortName();

            if (!array_key_exists($schemaName, $this->requiredSchemas)) {
                $this->requiredSchemas[$schemaName] = $object->getSchema();
            }

            return [
                '$ref' => '#/components/schemas/' . $schemaName
            ];
        }

        $properties = [];

        foreach ($object->getProperties() as $propertyName => $property) {
            $properties[$propertyName] = $this->handleProperty($property);
        }

        return array_filter([
            'type' => 'object',
            'properties' => $properties,
        ]);
    }

    private function handleProperty(Type $type): array
    {
        return match ($type::class) {
            ObjectType::class => $this->handleObject($type),
            StringType::class => $this->handleString($type),
            IntegerType::class => $this->handleInteger($type),
            NumberType::class => $this->handleNumber($type),
            BooleanType::class => $this->handleBoolean($type),
            ArrayType::class => $this->handleArray($type),
            default => [],
        };
    }

    private function handleObject(ObjectType $type): array
    {
        return $this->generate($type);
    }

    private function handleString(StringType $type): array
    {
        $values = [
            'type' => 'string',
            'format' => $type->getFormat()?->value,
            'example' => $type->getExample(),
            'nullable' => $type->isNullable(),
        ];

        return array_filter($values);
    }

    private function handleInteger(IntegerType $type): array
    {
        $values = [
            'type' => 'integer',
            'format' => $type->getFormat()?->value,
            'example' => $type->getExample(),
            'nullable' => $type->isNullable(),
        ];

        return array_filter($values);
    }

    private function handleNumber(NumberType $type): array
    {
        $values = [
            'type' => 'number',
            'format' => $type->getFormat()?->value,
            'example' => $type->getExample(),
            'nullable' => $type->isNullable(),
        ];

        return array_filter($values);
    }

    private function handleBoolean(BooleanType $type): array
    {
        $values = [
            'type' => 'boolean',
            'nullable' => $type->isNullable(),
        ];

        return array_filter($values);
    }

    private function handleArray(ArrayType $type): array
    {
        $arrayItems = $type->getItems();

        if (null === $arrayItems) {
            throw new ArrayItemsEmptyException('Array items cannot be empty!');
        }

        if ($arrayItems->getSchema() instanceof SchemaInterface) {
            $schemaName = (new ReflectionClass($arrayItems->getSchema()))->getShortName();

            if (!array_key_exists($schemaName, $this->requiredSchemas)) {
                $this->requiredSchemas[$schemaName] = $arrayItems->getSchema();
            }

            return [
                'type' => 'array',
                'items' => [
                    '$ref' => '#/components/schemas/' . $schemaName
                ]
            ];
        }

        return [
            'type' => 'array',
            'items' => $this->handleProperty($arrayItems->getItems()),
        ];
    }

    public function getRequiredSchemas(): array
    {
        return $this->requiredSchemas;
    }
}