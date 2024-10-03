<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Generator;

use Benedekb\OpenAPI\Component\Enum\ParameterLocation;
use Benedekb\OpenAPI\Component\OpenApiDefinitionInterface;
use Benedekb\OpenAPI\Component\Parameter;
use Benedekb\OpenAPI\Component\ResponseInterface;
use Benedekb\OpenAPI\Component\Tag;

class OperationGenerator
{
    public function __construct(
        private readonly RequestBodyGenerator $requestBodyGenerator,
        private readonly ResponseGenerator $responseGenerator,
    ) {}

    private array $requiredTags = [];

    public function generate(OpenApiDefinitionInterface $definition): array
    {
        $operation = [
            'tags' => $this->generateTags($definition),
            'summary' => $definition->getSummary(),
            'operationId' => $definition->getOperationId(),
            'parameters' => $this->generateParameters($definition),
        ];

        if (null !== $definition->getRequestBody()) {
            $operation['requestBody'] = $this->requestBodyGenerator->generate($definition->getRequestBody());
        }

        /** @var ResponseInterface $response */
        foreach ($definition->getResponses() as $response) {
            $operation['responses'][$response->getStatusCode()] =
                $this->responseGenerator->generate($response);
        }

        return array_filter($operation);
    }

    private function generateTags(OpenApiDefinitionInterface $definition): array
    {
        $tags = [];

        /** @var Tag $tag */
        foreach ($definition->getTags() as $tag) {
            $tags[] = $tag->getName();

            if (!array_key_exists($tag->getName(), $this->requiredTags)) {
                $this->requiredTags[$tag->getName()] = $tag;
            }
        }

        return $tags;
    }

    private function generateParameters(OpenApiDefinitionInterface $definition): array
    {
        $parameters = [];

        /** @var Parameter $parameter */
        foreach ($definition->getParameters() as $parameter) {
            if ($parameter->getLocation() === ParameterLocation::PATH) {
                continue;
            }

            $parameters[] = $parameter->toArray();
        }

        return $parameters;
    }

    public function getRequiredSchemas(): array
    {
        return array_merge(
            $this->responseGenerator->getRequiredSchemas(),
            $this->requestBodyGenerator->getRequiredSchemas()
        );
    }
}