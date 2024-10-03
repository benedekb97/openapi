<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Generator;

use Benedekb\OpenAPI\Component\ResponseInterface;

class ResponseGenerator
{
    public function __construct(
        private ObjectGenerator $objectGenerator,
    ) {}

    public function generate(ResponseInterface $response): array
    {
        return [
            'description' => $response->getDescription(),
            'content' => $this->objectGenerator->generate($response)
        ];
    }
}