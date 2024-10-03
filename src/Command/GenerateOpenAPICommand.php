<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Command;

use Benedekb\OpenAPI\Component\Generator\OpenApiGenerator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'openapi:generate')]
final class GenerateOpenAPICommand extends Command
{
    public function __construct(
        private readonly string $filePath,
        private readonly OpenApiGenerator $openApiGenerator
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->openApiGenerator->generate();

        return Command::SUCCESS;
    }
}