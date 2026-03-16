#!/usr/bin/env php
<?php

/**
 * Component Usage Analyzer
 *
 * Analyzes usage of components from the helsingborg-stad/component-library
 * in other repositories within the helsingborg-stad GitHub organization.
 *
 * Uses the GitHub Code Search API to find Blade directive usage patterns
 * like @componentName( across the organization, excluding the component-library itself.
 *
 * Usage:
 *   php analyze-component-usage.php [options]
 *
 * Options:
 *   --token=<token>    GitHub personal access token (recommended for higher rate limits).
 *                       Can also be set via GITHUB_TOKEN environment variable.
 *   --format=<format>  Output format: "table" (default) or "json".
 *   --unused-only      Only show unused components.
 *   --help             Show this help message.
 *
 * Examples:
 *   php analyze-component-usage.php --token=ghp_xxxx
 *   GITHUB_TOKEN=ghp_xxxx php analyze-component-usage.php --format=json
 *   php analyze-component-usage.php --unused-only
 *
 * Rate Limits:
 *   - Unauthenticated: 10 requests/minute (search API)
 *   - Authenticated:   30 requests/minute (search API)
 *
 * @see https://docs.github.com/en/rest/search/search?apiVersion=2022-11-28#search-code
 */

declare(strict_types=1);

namespace ComponentLibrary\Analyzer;

/**
 * Discovers component slugs from the component library source directory.
 */
class ComponentDiscovery
{
    private string $componentBasePath;

    public function __construct(string $componentBasePath)
    {
        $this->componentBasePath = rtrim($componentBasePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

    /**
     * Discover all component slugs by reading their JSON configuration files.
     *
     * @return string[] Array of component slugs (e.g., ['button', 'card', 'accordion'])
     */
    public function discoverSlugs(): array
    {
        $slugs      = [];
        $directories = glob($this->componentBasePath . '*', GLOB_ONLYDIR);

        if (!is_array($directories)) {
            return [];
        }

        foreach ($directories as $directory) {
            $slug = $this->readSlugFromConfig($directory);

            if ($slug !== null) {
                $slugs[] = $slug;
            }
        }

        sort($slugs);

        return $slugs;
    }

    /**
     * Read the component slug from its JSON configuration file.
     *
     * @param string $componentDirectory Full path to the component directory.
     *
     * @return string|null The component slug or null if not found.
     */
    private function readSlugFromConfig(string $componentDirectory): ?string
    {
        $directoryName = basename($componentDirectory);
        $configFile    = $componentDirectory . DIRECTORY_SEPARATOR . lcfirst($directoryName) . '.json';

        if (!file_exists($configFile)) {
            return null;
        }

        $contents = file_get_contents($configFile);

        if ($contents === false) {
            return null;
        }

        $config = json_decode($contents, true);

        if (!is_array($config) || !isset($config['slug'])) {
            return null;
        }

        return (string) $config['slug'];
    }
}

/**
 * Searches the GitHub Code Search API for component usage.
 */
class GitHubCodeSearchClient
{
    private const API_BASE_URL   = 'https://api.github.com/search/code';
    private const ORGANIZATION   = 'helsingborg-stad';
    private const EXCLUDED_REPO  = 'helsingborg-stad/component-library';
    private const PER_PAGE       = 100;
    private const USER_AGENT     = 'ComponentLibrary-UsageAnalyzer/1.0';

    private ?string $token;

    /** @var int Seconds to wait between API requests to respect rate limits. */
    private int $requestDelay;

    public function __construct(?string $token = null)
    {
        $this->token        = $token;
        $this->requestDelay = $token !== null ? 3 : 7;
    }

    /**
     * Search for usage of a component directive across the organization.
     *
     * @param string $slug The component slug (e.g., 'button').
     *
     * @return array{total_count: int, repositories: string[]} Search results.
     */
    public function searchComponentUsage(string $slug): array
    {
        $query        = $this->buildQuery($slug);
        $repositories = [];
        $totalCount   = 0;
        $page         = 1;

        do {
            $response = $this->executeSearch($query, $page);

            if ($response === null) {
                break;
            }

            $totalCount = $response['total_count'] ?? 0;
            $items      = $response['items'] ?? [];

            foreach ($items as $item) {
                $repoFullName = $item['repository']['full_name'] ?? '';

                if ($repoFullName !== '' && $repoFullName !== self::EXCLUDED_REPO) {
                    $repositories[$repoFullName] = true;
                }
            }

            $page++;
            $hasMorePages = count($items) === self::PER_PAGE && $page <= 10;

            if ($hasMorePages) {
                sleep($this->requestDelay);
            }
        } while ($hasMorePages);

        return [
            'total_count'  => $totalCount,
            'repositories' => array_keys($repositories),
        ];
    }

    /**
     * Build the search query for a component directive.
     *
     * Searches for the Blade directive pattern: @slug(
     *
     * @param string $slug The component slug.
     *
     * @return string The search query string.
     */
    private function buildQuery(string $slug): string
    {
        return sprintf(
            '@%s( org:%s -repo:%s',
            $slug,
            self::ORGANIZATION,
            self::EXCLUDED_REPO
        );
    }

    /**
     * Execute a search API request.
     *
     * @param string $query The search query.
     * @param int    $page  The page number.
     *
     * @return array<string, mixed>|null Decoded response or null on failure.
     */
    private function executeSearch(string $query, int $page): ?array
    {
        $url = sprintf(
            '%s?q=%s&per_page=%d&page=%d',
            self::API_BASE_URL,
            urlencode($query),
            self::PER_PAGE,
            $page
        );

        $headers = [
            'Accept: application/vnd.github.v3+json',
            'User-Agent: ' . self::USER_AGENT,
            'X-GitHub-Api-Version: 2022-11-28',
        ];

        if ($this->token !== null) {
            $headers[] = 'Authorization: Bearer ' . $this->token;
        }

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_FOLLOWLOCATION => true,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $httpCode !== 200) {
            if ($httpCode === 403 || $httpCode === 429) {
                $this->handleRateLimit($response);

                return null;
            }

            return null;
        }

        $decoded = json_decode($response, true);

        return is_array($decoded) ? $decoded : null;
    }

    /**
     * Handle rate limit responses by waiting for the reset window.
     *
     * @param string|false $response The raw API response.
     */
    private function handleRateLimit($response): void
    {
        $decoded = is_string($response) ? json_decode($response, true) : null;
        $message = $decoded['message'] ?? 'Rate limit exceeded';

        fwrite(STDERR, "  ⚠ Rate limited: {$message}. Waiting 60 seconds...\n");
        sleep(60);
    }

    /**
     * Get the request delay between API calls.
     */
    public function getRequestDelay(): int
    {
        return $this->requestDelay;
    }
}

/**
 * Formats and outputs the analysis results.
 */
class ResultFormatter
{
    /**
     * Format results as a human-readable table.
     *
     * @param array<string, array{total_count: int, repositories: string[]}> $results
     * @param bool $unusedOnly Only show unused components.
     *
     * @return string Formatted output.
     */
    public function formatTable(array $results, bool $unusedOnly = false): string
    {
        $output = '';
        $used   = [];
        $unused = [];

        foreach ($results as $slug => $data) {
            if (empty($data['repositories'])) {
                $unused[] = $slug;
            } else {
                $used[$slug] = $data;
            }
        }

        if (!$unusedOnly) {
            $output .= $this->formatUsedComponentsTable($used);
        }

        $output .= $this->formatUnusedComponentsList($unused);
        $output .= $this->formatSummary(count($results), count($used), count($unused));

        return $output;
    }

    /**
     * Format results as JSON.
     *
     * @param array<string, array{total_count: int, repositories: string[]}> $results
     *
     * @return string JSON-encoded output.
     */
    public function formatJson(array $results): string
    {
        $used   = [];
        $unused = [];

        foreach ($results as $slug => $data) {
            if (empty($data['repositories'])) {
                $unused[] = $slug;
            } else {
                $used[$slug] = [
                    'total_count'  => $data['total_count'],
                    'repositories' => $data['repositories'],
                ];
            }
        }

        return json_encode([
            'summary' => [
                'total_components'  => count($results),
                'used_components'   => count($used),
                'unused_components' => count($unused),
            ],
            'used'   => $used,
            'unused' => $unused,
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
    }

    /**
     * Format the used components section.
     *
     * @param array<string, array{total_count: int, repositories: string[]}> $used
     *
     * @return string Formatted table.
     */
    private function formatUsedComponentsTable(array $used): string
    {
        if (empty($used)) {
            return '';
        }

        $output  = "\n";
        $output .= "=============================================================\n";
        $output .= " USED COMPONENTS\n";
        $output .= "=============================================================\n\n";

        $output .= sprintf("  %-25s %-8s %s\n", 'Component', 'Hits', 'Repositories');
        $output .= sprintf("  %-25s %-8s %s\n", str_repeat('-', 25), str_repeat('-', 8), str_repeat('-', 40));

        foreach ($used as $slug => $data) {
            $repos   = implode(', ', $data['repositories']);
            $output .= sprintf("  %-25s %-8d %s\n", '@' . $slug, $data['total_count'], $repos);
        }

        $output .= "\n";

        return $output;
    }

    /**
     * Format the unused components section.
     *
     * @param string[] $unused
     *
     * @return string Formatted list.
     */
    private function formatUnusedComponentsList(array $unused): string
    {
        $output  = "=============================================================\n";
        $output .= " UNUSED COMPONENTS (not found in other repositories)\n";
        $output .= "=============================================================\n\n";

        if (empty($unused)) {
            $output .= "  All components are used in other repositories!\n\n";

            return $output;
        }

        foreach ($unused as $slug) {
            $output .= "  • @{$slug}\n";
        }

        $output .= "\n";

        return $output;
    }

    /**
     * Format the summary section.
     *
     * @param int $total  Total number of components.
     * @param int $used   Number of used components.
     * @param int $unused Number of unused components.
     *
     * @return string Formatted summary.
     */
    private function formatSummary(int $total, int $used, int $unused): string
    {
        $output  = "=============================================================\n";
        $output .= " SUMMARY\n";
        $output .= "=============================================================\n\n";
        $output .= "  Total components: {$total}\n";
        $output .= "  Used:             {$used}\n";
        $output .= "  Unused:           {$unused}\n\n";

        return $output;
    }
}

/**
 * Main application class that orchestrates the analysis.
 */
class ComponentUsageAnalyzer
{
    private ComponentDiscovery $discovery;
    private GitHubCodeSearchClient $client;
    private ResultFormatter $formatter;

    public function __construct(
        ComponentDiscovery $discovery,
        GitHubCodeSearchClient $client,
        ResultFormatter $formatter
    ) {
        $this->discovery = $discovery;
        $this->client    = $client;
        $this->formatter = $formatter;
    }

    /**
     * Run the component usage analysis.
     *
     * @param string $format     Output format: "table" or "json".
     * @param bool   $unusedOnly Only show unused components.
     *
     * @return string Formatted output.
     */
    public function analyze(string $format = 'table', bool $unusedOnly = false): string
    {
        $slugs   = $this->discovery->discoverSlugs();
        $results = [];

        fwrite(STDERR, sprintf("Analyzing %d components...\n\n", count($slugs)));

        foreach ($slugs as $index => $slug) {
            $position = $index + 1;
            fwrite(STDERR, sprintf("  [%d/%d] Searching for @%s( ...", $position, count($slugs), $slug));

            $result         = $this->client->searchComponentUsage($slug);
            $results[$slug] = $result;
            $repoCount      = count($result['repositories']);
            $repoLabel      = $repoCount === 1 ? 'repo' : 'repos';

            fwrite(STDERR, sprintf(
                " %d hit(s) in %d %s\n",
                $result['total_count'],
                $repoCount,
                $repoLabel
            ));

            if ($index < count($slugs) - 1) {
                sleep($this->client->getRequestDelay());
            }
        }

        fwrite(STDERR, "\n");

        if ($format === 'json') {
            return $this->formatter->formatJson($results);
        }

        return $this->formatter->formatTable($results, $unusedOnly);
    }
}

// ─── CLI Entry Point ────────────────────────────────────────────────────────────

/**
 * Parse command-line arguments.
 *
 * @param string[] $argv
 *
 * @return array{token: ?string, format: string, unused_only: bool, help: bool}
 */
function parseArguments(array $argv): array
{
    $options = [
        'token'       => null,
        'format'      => 'table',
        'unused_only' => false,
        'help'        => false,
    ];

    foreach ($argv as $arg) {
        if (str_starts_with($arg, '--token=')) {
            $options['token'] = substr($arg, 8);
        } elseif (str_starts_with($arg, '--format=')) {
            $options['format'] = substr($arg, 9);
        } elseif ($arg === '--unused-only') {
            $options['unused_only'] = true;
        } elseif ($arg === '--help' || $arg === '-h') {
            $options['help'] = true;
        }
    }

    if ($options['token'] === null) {
        $envToken = getenv('GITHUB_TOKEN');

        if ($envToken !== false && $envToken !== '') {
            $options['token'] = $envToken;
        }
    }

    return $options;
}

/**
 * Print usage information.
 */
function printHelp(): void
{
    $help = <<<'HELP'
Component Usage Analyzer
========================

Analyzes usage of components from helsingborg-stad/component-library
in other repositories within the helsingborg-stad GitHub organization.

Usage:
  php analyze-component-usage.php [options]

Options:
  --token=<token>    GitHub personal access token (recommended for higher rate limits).
                     Can also be set via GITHUB_TOKEN environment variable.
  --format=<format>  Output format: "table" (default) or "json".
  --unused-only      Only show unused components.
  --help, -h         Show this help message.

Examples:
  php analyze-component-usage.php --token=ghp_xxxx
  GITHUB_TOKEN=ghp_xxxx php analyze-component-usage.php --format=json
  php analyze-component-usage.php --unused-only

Rate Limits:
  Unauthenticated: 10 requests/minute (search API)
  Authenticated:   30 requests/minute (search API)

HELP;

    echo $help;
}

// Only run when executed directly (not when included for testing).
if (php_sapi_name() === 'cli' && isset($argv[0]) && realpath($argv[0]) === realpath(__FILE__)) {
    $options = parseArguments($argv);

    if ($options['help']) {
        printHelp();
        exit(0);
    }

    if (!in_array($options['format'], ['table', 'json'], true)) {
        fwrite(STDERR, "Error: Invalid format. Use 'table' or 'json'.\n");
        exit(1);
    }

    $componentBasePath = __DIR__ . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'php'
        . DIRECTORY_SEPARATOR . 'Component' . DIRECTORY_SEPARATOR;

    if (!is_dir($componentBasePath)) {
        fwrite(STDERR, "Error: Component directory not found: {$componentBasePath}\n");
        exit(1);
    }

    $discovery = new ComponentDiscovery($componentBasePath);
    $client    = new GitHubCodeSearchClient($options['token']);
    $formatter = new ResultFormatter();
    $analyzer  = new ComponentUsageAnalyzer($discovery, $client, $formatter);

    echo $analyzer->analyze($options['format'], $options['unused_only']);
}
