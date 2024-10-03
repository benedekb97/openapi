<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'openapi:generate')]
class GenerateOpenApiCommand extends Command
{

}