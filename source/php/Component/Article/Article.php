<?php

namespace ComponentLibrary\Component\Article;

use DomDocument;
use DOMXPath;

class Article extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        $this->data['tableOfContents'] = $this->getTableOfContentsFromHtml(
            $this->data['slot'] ?? ''
        );
    }

    /**
     * Extracts a nested table of contents from the provided HTML content.
     *
     * @param string $html The HTML content to extract the table of contents from.
     * @param int $startLevel The starting heading level to consider (default is 2).
     * @param int $maxDepth The maximum depth of headings to include (default is 3).
     * @return array A nested array of headings with their text, level, and slug.
     */
    private function getTableOfContentsFromHtml(string $html, int $startLevel = 2, int $maxDepth = 3): array
    {
        if (empty($html) || !is_string($html)) {
            return [];
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $loaded = @$dom->loadHTML($html);
        libxml_clear_errors();

        if (!$loaded) {
            return [];
        }

        $xpath = new \DOMXPath($dom);
        $headings = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');

        if (!$headings || $headings->length === 0) {
            return [];
        }

        // Collect headings within the specified levels
        $items = [];
        foreach ($headings as $heading) {
            $level = (int) substr($heading->nodeName, 1);
            if ($level < $startLevel || $level >= $startLevel + $maxDepth) {
                continue;
            }
            $items[] = [
                'text' => trim($heading->textContent),
                'level' => $level,
                'slug' => strtolower(trim(preg_replace('/[^a-z0-9]+/', '-', $heading->textContent))),
                'children' => [],
            ];
        }

        // Build nested structure
        $toc = [];
        $stack = [];
        foreach ($items as $item) {
            while (!empty($stack) && $item['level'] <= end($stack)['level']) {
                array_pop($stack);
            }
            if (empty($stack)) {
                $toc[] = $item;
                $stack[] = &$toc[array_key_last($toc)];
            } else {
                $parent = &$stack[array_key_last($stack)];
                $parent['children'][] = $item;
                $stack[] = &$parent['children'][array_key_last($parent['children'])];
            }
        }

        return $toc;
    }
}
