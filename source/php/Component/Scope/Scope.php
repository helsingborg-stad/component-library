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
            $dom = new \DOMDocument();
            @$dom->loadHTML('<div id="__scope_root__">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $root = $dom->getElementById('__scope_root__');

            if (!$root) {
                return $inner;
            }

            foreach ($root->childNodes as $child) {
                if ($child instanceof \DOMElement) {
                    $child->setAttribute('data-scope', $scopes);
                }
            }

            $newHtml = '';
            foreach ($root->childNodes as $child) {
                $newHtml .= $dom->saveHTML($child);
            }
            return new HtmlString($newHtml);
        };
    }
}
