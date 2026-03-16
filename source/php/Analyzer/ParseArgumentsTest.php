<?php

declare(strict_types=1);

namespace ComponentLibrary\Analyzer;

use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__, 3) . '/analyze-component-usage.php';

class ParseArgumentsTest extends TestCase
{
    /**
     * @testdox it parses token argument
     */
    public function testParsesTokenArgument(): void
    {
        $args    = ['script.php', '--token=ghp_test123'];
        $options = parseArguments($args);

        $this->assertSame('ghp_test123', $options['token']);
    }

    /**
     * @testdox it parses format argument
     */
    public function testParsesFormatArgument(): void
    {
        $args    = ['script.php', '--format=json'];
        $options = parseArguments($args);

        $this->assertSame('json', $options['format']);
    }

    /**
     * @testdox it parses unused-only flag
     */
    public function testParsesUnusedOnlyFlag(): void
    {
        $args    = ['script.php', '--unused-only'];
        $options = parseArguments($args);

        $this->assertTrue($options['unused_only']);
    }

    /**
     * @testdox it parses help flag
     */
    public function testParsesHelpFlag(): void
    {
        $args    = ['script.php', '--help'];
        $options = parseArguments($args);

        $this->assertTrue($options['help']);
    }

    /**
     * @testdox it uses default values when no arguments provided
     */
    public function testDefaultValues(): void
    {
        $args    = ['script.php'];
        $options = parseArguments($args);

        $this->assertSame('table', $options['format']);
        $this->assertFalse($options['unused_only']);
        $this->assertFalse($options['help']);
    }

    /**
     * @testdox it reads token from environment variable
     */
    public function testReadsTokenFromEnvironment(): void
    {
        $previousValue = getenv('GITHUB_TOKEN');
        putenv('GITHUB_TOKEN=env_token_123');

        $args    = ['script.php'];
        $options = parseArguments($args);

        $this->assertSame('env_token_123', $options['token']);

        // Restore previous environment
        if ($previousValue !== false) {
            putenv('GITHUB_TOKEN=' . $previousValue);
        } else {
            putenv('GITHUB_TOKEN');
        }
    }

    /**
     * @testdox CLI argument takes precedence over environment variable
     */
    public function testCliTokenOverridesEnvToken(): void
    {
        $previousValue = getenv('GITHUB_TOKEN');
        putenv('GITHUB_TOKEN=env_token');

        $args    = ['script.php', '--token=cli_token'];
        $options = parseArguments($args);

        $this->assertSame('cli_token', $options['token']);

        if ($previousValue !== false) {
            putenv('GITHUB_TOKEN=' . $previousValue);
        } else {
            putenv('GITHUB_TOKEN');
        }
    }
}
