<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Schema\Enum;

enum StringFormat: string
{
    case PASSWORD = 'password';
    case DATETIME = 'date-time';
    case DATE = 'date';
    case EMAIL = 'email';
    case HOSTNAME = 'hostname';
    case IPV4 = 'ipv4';
    case IPV6 = 'ipv6';
    case UUID = 'uuid';
}
