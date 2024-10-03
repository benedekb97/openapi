<?php

declare(strict_types=1);

namespace Benedekb\OpenAPI\Tests;

use Benedekb\OpenAPI\DependencyInjection\OpenAPIExtension;
use Benedekb\OpenAPI\OpenAPIBundle;
use PHPUnit\Framework\TestCase;

class OpenAPIExtensionTest extends TestCase
{
    public function testGetContainerExtension(): void
    {
        $bundle = new OpenAPIBundle();

        $this->assertInstanceOf(OpenAPIExtension::class, $bundle->getContainerExtension());
    }
}