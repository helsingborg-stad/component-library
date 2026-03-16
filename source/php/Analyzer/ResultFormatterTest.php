<?php

declare(strict_types=1);

namespace ComponentLibrary\Analyzer;

use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__, 3) . '/analyze-component-usage.php';

class ResultFormatterTest extends TestCase
{
    /**
     * @testdox it formats used components in table format
     */
    public function testFormatTableShowsUsedComponents(): void
    {
        $formatter = new ResultFormatter();

        $results = [
            'button' => [
                'total_count'  => 42,
                'repositories' => ['helsingborg-stad/theme-a', 'helsingborg-stad/theme-b'],
            ],
            'card' => [
                'total_count'  => 0,
                'repositories' => [],
            ],
        ];

        $output = $formatter->formatTable($results);

        $this->assertStringContainsString('@button', $output);
        $this->assertStringContainsString('42', $output);
        $this->assertStringContainsString('theme-a', $output);
        $this->assertStringContainsString('theme-b', $output);
        $this->assertStringContainsString('USED COMPONENTS', $output);
        $this->assertStringContainsString('UNUSED COMPONENTS', $output);
        $this->assertStringContainsString('@card', $output);
    }

    /**
     * @testdox it formats unused-only output correctly
     */
    public function testFormatTableUnusedOnly(): void
    {
        $formatter = new ResultFormatter();

        $results = [
            'button' => [
                'total_count'  => 42,
                'repositories' => ['helsingborg-stad/theme-a'],
            ],
            'card' => [
                'total_count'  => 0,
                'repositories' => [],
            ],
        ];

        $output = $formatter->formatTable($results, true);

        $this->assertStringNotContainsString(' USED COMPONENTS' . "\n", $output);
        $this->assertStringContainsString('UNUSED COMPONENTS', $output);
        $this->assertStringContainsString('@card', $output);
    }

    /**
     * @testdox it formats JSON output with correct structure
     */
    public function testFormatJsonReturnsValidJson(): void
    {
        $formatter = new ResultFormatter();

        $results = [
            'button' => [
                'total_count'  => 10,
                'repositories' => ['helsingborg-stad/theme-a'],
            ],
            'card' => [
                'total_count'  => 0,
                'repositories' => [],
            ],
        ];

        $jsonOutput = $formatter->formatJson($results);
        $decoded    = json_decode($jsonOutput, true);

        $this->assertIsArray($decoded);
        $this->assertArrayHasKey('summary', $decoded);
        $this->assertArrayHasKey('used', $decoded);
        $this->assertArrayHasKey('unused', $decoded);

        $this->assertSame(2, $decoded['summary']['total_components']);
        $this->assertSame(1, $decoded['summary']['used_components']);
        $this->assertSame(1, $decoded['summary']['unused_components']);

        $this->assertArrayHasKey('button', $decoded['used']);
        $this->assertSame(10, $decoded['used']['button']['total_count']);
        $this->assertContains('helsingborg-stad/theme-a', $decoded['used']['button']['repositories']);

        $this->assertContains('card', $decoded['unused']);
    }

    /**
     * @testdox it shows summary with correct counts
     */
    public function testFormatTableShowsSummary(): void
    {
        $formatter = new ResultFormatter();

        $results = [
            'button' => ['total_count' => 5, 'repositories' => ['repo-a']],
            'card'   => ['total_count' => 0, 'repositories' => []],
            'icon'   => ['total_count' => 3, 'repositories' => ['repo-b']],
        ];

        $output = $formatter->formatTable($results);

        $this->assertStringContainsString('Total components: 3', $output);
        $this->assertStringContainsString('Used:             2', $output);
        $this->assertStringContainsString('Unused:           1', $output);
    }

    /**
     * @testdox it handles all components being unused
     */
    public function testFormatTableAllUnused(): void
    {
        $formatter = new ResultFormatter();

        $results = [
            'widget' => ['total_count' => 0, 'repositories' => []],
            'gadget' => ['total_count' => 0, 'repositories' => []],
        ];

        $output = $formatter->formatTable($results);

        $this->assertStringContainsString('UNUSED COMPONENTS', $output);
        $this->assertStringContainsString('@widget', $output);
        $this->assertStringContainsString('@gadget', $output);
        $this->assertStringContainsString('Unused:           2', $output);
    }

    /**
     * @testdox it handles all components being used
     */
    public function testFormatTableAllUsed(): void
    {
        $formatter = new ResultFormatter();

        $results = [
            'button' => ['total_count' => 10, 'repositories' => ['repo-a']],
        ];

        $output = $formatter->formatTable($results);

        $this->assertStringContainsString('All components are used', $output);
    }
}
