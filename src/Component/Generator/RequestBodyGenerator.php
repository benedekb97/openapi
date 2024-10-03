<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Generator;

use Benedekb\OpenAPI\Component\RequestBodyInterface;

class RequestBodyGenerator
{
    public function __construct(
        private ObjectGenerator $objectGenerator,
    ) {}

    public function generate(RequestBodyInterface $requestBody): array
    {
        return [
            'description' => $requestBody->getDescription(),
            'content' => [
                $requestBody->getContentType()->value => [
                    'schema' => $this->objectGenerator->generate($requestBody),
                ]
            ],
            'required' => $requestBody->isRequired(),
        ];
    }
}