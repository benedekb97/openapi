<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Component\Exception;

use Exception;

class DuplicatePropertyException extends Exception
{
    public function __construct(string $name)
    {
        parent::__construct(
            sprintf('Duplicate key %s!', $name)
        );
    }
}