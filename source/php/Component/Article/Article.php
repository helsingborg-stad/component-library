<?php

namespace ComponentLibrary\Component\Article;

use DOMDocument;
use DOMXPath;
use DOMElement;

class Article extends \ComponentLibrary\Component\BaseController
{
    private const ANCHOR_PREFIX = 'toc-';

    /**
     * Initializes the component by generating a table of contents and injecting slugs.
     *
     * @return void
     */
    public function init(): void
    {
        //Get headings
        $headings = self::extractHeadingsFromHtml(
            $this->data['slot'] ?? ''
        );

        //Process headings
        if(!empty($headings)) {
            $this->data['tableOfContents']  = self::buildNestedToc($headings);
            $this->data['slot']             = self::injectSlugsIntoHtml(
                $this->data['slot'] ?? '', 
                $headings
            );
        } else {
            $this->data['tableOfContents'] = false;
        }
    }

    /**
     * Creates and returns a DOMDocument from the provided HTML string.
     *
     * @param string $html
     * @return DOMDocument
     */
    private static function createDomFromHtml(string $html): DOMDocument
    {
        $dom = new DOMDocument();

        libxml_use_internal_errors(true);
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        libxml_clear_errors();

        return $dom;
    }

    /**
     * Extracts headings (h1–h6) from the HTML and returns them as an array.
     *
     * @param string $html
     * @return array
     */
    private static function extractHeadingsFromHtml(string $html): array
    {
        if (empty($html)) return [];

        $dom = self::createDomFromHtml($html);

        $xpath = new DOMXPath($dom);
        $elements = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');

        $headings = [];
        foreach ($elements as $el) {
            if (!$el instanceof DOMElement) continue;

            $text = trim($el->textContent);
            $level = (int) substr($el->nodeName, 1);
            $slug = self::generateSlug($text);

            $headings[] = compact('text', 'level', 'slug');
        }

        return $headings;
    }

    /**
     * Injects slug-based IDs into headings within the HTML.
     *
     * @param string $html
     * @param array $headings
     * @return string
     */
    private static function injectSlugsIntoHtml(string $html, array $headings): string
    {
        if (empty($html) || empty($headings)) return $html;

        $dom = self::createDomFromHtml($html);

        $xpath = new DOMXPath($dom);
        $elements = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');

        foreach ($elements as $i => $el) {
            if (isset($headings[$i]) && $el instanceof DOMElement) {
                $el->setAttribute('id', $headings[$i]['slug']);
            }
        }

        return $dom->saveHTML();
    }

    /**
     * Builds a nested table of contents array based on heading levels.
     *
     * @param array $headings
     * @param int $startLevel
     * @param int $maxDepth
     * @return array
     */
    private static function buildNestedToc(array $headings, int $startLevel = 2, int $maxDepth = 3): array
    {
        $items = array_filter($headings, fn($h) => $h['level'] >= $startLevel && $h['level'] < $startLevel + $maxDepth);

        $toc = $stack = [];
        foreach ($items as $item) {
            $tocItem = ['label' => $item['text'], 'level' => $item['level'], 'href' => '#' . $item['slug'], 'children' => []];
            while (!empty($stack) && $tocItem['level'] <= end($stack)['level']) array_pop($stack);

            if (empty($stack)) {
                $toc[] = $tocItem;
                $stack[] = &$toc[array_key_last($toc)];
            } else {
                $parent = &$stack[array_key_last($stack)];
                $parent['children'][] = $tocItem;
                $stack[] = &$parent['children'][array_key_last($parent['children'])];
            }
        }

        return $toc;
    }

    /**
     * Generates a URL-safe slug from the given text.
     *
     * @param string $text
     * @return string
     */
    private static function generateSlug(string $text): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $text)));
        return self::ANCHOR_PREFIX . $slug;
    }
}
