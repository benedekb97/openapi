<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema\Enum;

enum NumberFormat: string
{
    case DOUBLE = 'double';
    case FLOAT = 'float';
}