<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Enum;

enum ParameterLocation: string
{
    case PATH = 'path';
    case QUERY = 'query';
    case HEADER = 'header';
    case COOKIE = 'cookie';
}
