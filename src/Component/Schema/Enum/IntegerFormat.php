<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema\Enum;

enum IntegerFormat: string
{
    case INT32 = 'int32';
    case INT64 = 'int64';
}