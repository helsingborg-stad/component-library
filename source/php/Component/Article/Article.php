<?php

namespace ComponentLibrary\Component\Article;

use DomDocument;
use DOMXPath;

class Article extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        // Create table of contents from the slot content
        $this->data['tableOfContents'] = $this->getTableOfContentsFromHtml(
            $this->data['slot'] ?? ''
        );

        // Add slugs to headings in the slot content
        $this->data['slot'] = $this->addSlugsToHeadings(
            $this->data['slot'] ?? ''
        );

        // Sectionize the slot content
        /*$this->data['slot'] = $this->sectionizeContent(
            $this->data['slot'] ?? ''
        );*/ 
    }

    /**
     * Sectionizes the provided HTML content by wrapping it in a section tag.
     *
     * @param string $html The HTML content to sectionize.
     * @return string The sectionized HTML content.
     */
    private function sectionizeContent(string $html): string
    {
        if (empty($html) || !is_string($html)) {
            return $html;
        }

        // Create a new DOMDocument instance
        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        $loaded = @$dom->loadHTML($html);
        libxml_clear_errors();

        if (!$loaded) {
            return $html;
        }

        // Create a section element
        $section = $dom->createElement('section');
        $section->setAttribute('class', 'article-content');

        // Import the existing HTML into the section
        $fragment = $dom->createDocumentFragment();
        $fragment->appendXML($html);
        $section->appendChild($fragment);

        // Replace the body content with the section
        $body = $dom->getElementsByTagName('body')->item(0);
        if ($body) {
            while ($body->firstChild) {
                $body->removeChild($body->firstChild);
            }
            $body->appendChild($section);
        }

        return $dom->saveHTML();
    }

    /**
     * Adds slugs to headings in the provided HTML content.
     *
     * @param string $html The HTML content to process.
     * @return string The HTML content with slugs added to headings.
     */
    private function addSlugsToHeadings(string $html): string
    {
        if (empty($html) || !is_string($html)) {
            return $html;
        }

        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        $loaded = @$dom->loadHTML($html);
        libxml_clear_errors();

        if (!$loaded) {
            return $html;
        }

        $xpath = new DOMXPath($dom);
        $headings = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');

        foreach ($headings as $heading) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $heading->textContent)));
            $heading->setAttribute('id', $slug);
        }

        return $dom->saveHTML();
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
                'label' => trim($heading->textContent),
                'level' => $level,
                'href' => "#" . strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $heading->textContent))),
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
