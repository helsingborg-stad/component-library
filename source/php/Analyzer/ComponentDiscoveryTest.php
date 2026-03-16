<?php

declare(strict_types=1);

namespace ComponentLibrary\Analyzer;

use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__, 3) . '/analyze-component-usage.php';

class ComponentDiscoveryTest extends TestCase
{
    /**
     * @testdox it discovers component slugs from the component directory
     */
    public function testDiscoverSlugsReturnsArrayOfSlugs(): void
    {
        $componentPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Component' . DIRECTORY_SEPARATOR;
        $discovery     = new ComponentDiscovery($componentPath);

        $slugs = $discovery->discoverSlugs();

        $this->assertIsArray($slugs);
        $this->assertNotEmpty($slugs);
    }

    /**
     * @testdox it finds known components like button, card, and icon
     */
    public function testDiscoverSlugsContainsKnownComponents(): void
    {
        $componentPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Component' . DIRECTORY_SEPARATOR;
        $discovery     = new ComponentDiscovery($componentPath);

        $slugs = $discovery->discoverSlugs();

        $this->assertContains('button', $slugs);
        $this->assertContains('card', $slugs);
        $this->assertContains('icon', $slugs);
        $this->assertContains('accordion', $slugs);
        $this->assertContains('typography', $slugs);
    }

    /**
     * @testdox it returns sorted slugs
     */
    public function testDiscoverSlugsReturnsSortedArray(): void
    {
        $componentPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Component' . DIRECTORY_SEPARATOR;
        $discovery     = new ComponentDiscovery($componentPath);

        $slugs  = $discovery->discoverSlugs();
        $sorted = $slugs;
        sort($sorted);

        $this->assertSame($sorted, $slugs);
    }

    /**
     * @testdox it returns empty array for non-existent directory
     */
    public function testDiscoverSlugsReturnsEmptyForInvalidPath(): void
    {
        $discovery = new ComponentDiscovery('/nonexistent/path');

        // glob returns false or empty array for non-existent paths
        $slugs = $discovery->discoverSlugs();

        $this->assertIsArray($slugs);
        $this->assertEmpty($slugs);
    }

    /**
     * @testdox it returns empty array for directory with no components
     */
    public function testDiscoverSlugsReturnsEmptyForEmptyDirectory(): void
    {
        $tempDir   = sys_get_temp_dir() . '/component-test-empty-' . uniqid();
        mkdir($tempDir, 0755, true);

        $discovery = new ComponentDiscovery($tempDir);
        $slugs     = $discovery->discoverSlugs();

        $this->assertIsArray($slugs);
        $this->assertEmpty($slugs);

        rmdir($tempDir);
    }
}
