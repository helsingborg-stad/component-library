<?php

namespace ComponentLibrary\Component\Scope;

use Illuminate\Support\HtmlString;

class Scope extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        $scopes = '';

        if (is_array($this->data['name']) && !empty($this->data['name'])) {
            $scopes = array_filter($this->data['name']);
            $scopes = array_map(fn($scope) => 's-' . $scope . ';', $scopes);
            $scopes = implode(' ', $scopes);
        } elseif (is_string($this->data['name']) && !empty($this->data['name'])) {
            $scopes = 's-' . $this->data['name'] . ';';
        }

        if (empty($scopes)) {
            $this->data['applyScope'] = fn(HtmlString $inner) => $inner;
        } else {
            $this->data['applyScope'] = $this->createApplyScopeCallable($scopes);
        }
    }

    private function createApplyScopeCallable(string $scopes): callable
    {
        return function (HtmlString $inner) use ($scopes): HtmlString {
            $html = $inner->toHtml();
            return new HtmlString($this->addScopeToTopLevel($html, $scopes));
        };
    }

    private function addScopeToTopLevel(string $html, string $scopes): string
    {
        $depth = 0;
        $output = '';
        $offset = 0;

        preg_match_all('/<\/?([a-zA-Z][a-zA-Z0-9:-]*)([^>]*)>/', $html, $matches, PREG_OFFSET_CAPTURE);

        foreach ($matches[0] as $i => $match) {
            [$tag, $pos] = $match;

            $output .= substr($html, $offset, $pos - $offset);

            $isClosing = str_starts_with($tag, '</');

            if (!$isClosing && $depth === 0) {
                // inject attribute
                if (!str_contains($tag, 'data-scope=')) {
                    $tag = rtrim($tag, '>') . ' data-scope="' . $scopes . '">';
                }
            }

            $output .= $tag;

            $depth += $isClosing ? -1 : 1;
            $offset = $pos + strlen($match[0]);
        }

        $output .= substr($html, $offset);

        return $output;
    }
}
