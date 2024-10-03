<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Generator;

use Benedekb\OpenAPI\Component\ResponseInterface;

readonly class ResponseGenerator
{
    public function __construct(
        private ObjectGenerator $objectGenerator,
    ) {}

    public function generate(ResponseInterface $response): array
    {
        return [
            'description' => $response->getDescription(),
            'content' => [
                $response->getContentType()->value => [
                    'schema' => $this->objectGenerator->generate($response),
                ]
            ]
        ];
    }

    public function getRequiredSchemas(): array
    {
        return $this->objectGenerator->getRequiredSchemas();
    }
}