<?php

namespace Tests\Unit;

use Mmnijas\Avatar\Generate;
use Intervention\Image\Image;
use PHPUnit\Framework\TestCase;

class GenerateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Set up any necessary environment, e.g., mocking or configuration.
    }

    public function test_getBackgroundColor_returns_valid_hex_color()
    {
        // Use reflection to access the private method
        $reflection = new \ReflectionClass(Generate::class);
        $method = $reflection->getMethod('getBackgroundColor');
        $method->setAccessible(true);

        // Call the method and get the background color
        $color = $method->invoke(null);

        // Assert that the color is a valid hex color
        $this->assertMatchesRegularExpression('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $color);
    }
}
