<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Enum;

enum ContentType: string
{
    case APPLICATION_JSON = 'application/json';
    case APPLICATION_XML = 'application/xml';
}