<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Collector;

use Benedekb\OpenAPI\Component\Schema\AbstractSchema;
use Benedekb\OpenAPI\Component\Schema\SchemaInterface;
use Benedekb\OpenAPI\Component\Schema\Types\ArrayType;
use Benedekb\OpenAPI\Component\Schema\Types\ObjectType;
use ReflectionClass;

class SchemaCollector
{
    private array $schemas = [];

    public function collect(array $schemas): array
    {
        $this->schemas = $schemas;

        /** @var SchemaInterface|AbstractSchema $schema */
        foreach ($this->schemas as $schema) {
            $schema->setUp();

            foreach ($schema->getProperties() as $property) {
                if ($property instanceof ObjectType) {
                    $this->parseObject($property);
                }

                if ($property instanceof ArrayType) {
                    $this->parseArray($property);
                }
            }
        }

        return $this->schemas;
    }

    private function parseObject(ObjectType $object): void
    {
        /** @var AbstractSchema|SchemaInterface $schema */
        if (null !== $schema = $object->getSchema()) {
            $this->addSchema($schema);

            $schema->setUp();

            $this->parseObject($schema);

            return;
        }

        foreach ($object->getProperties() as $property) {
            if ($property instanceof ObjectType) {
                $this->parseObject($property);
            }

            if ($property instanceof ArrayType) {
                $this->parseArray($property);
            }
        }
    }

    private function parseArray(ArrayType $array): void
    {
        /** @var AbstractSchema|SchemaInterface $schema */
        if (null === $schema = $array->getItems()->getSchema()) {
            return;
        }

        $this->addSchema($schema);

        $schema->setUp();

        $this->parseObject($schema);
    }

    private function addSchema(SchemaInterface $schema): void
    {
        $schemaName = (new ReflectionClass($schema))->getShortName();

        if (!array_key_exists($schemaName, $this->schemas)) {
            $this->schemas[$schemaName] = $schema;
        }
    }
}