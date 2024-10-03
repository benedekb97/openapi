<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component;

interface ResponseInterface
{
    public function getStatusCode(): int;
}