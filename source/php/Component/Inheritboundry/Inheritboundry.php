<?php

namespace ComponentLibrary\Component\Inheritboundry;

use Illuminate\Support\HtmlString;

class Inheritboundry extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        $this->data['applyInheritBoundary'] = function (HtmlString $inner): HtmlString {
            $html = $inner->toHtml();
            $depth = 0;
            $offset = 0;
            $output = '';
            $voidElements = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr'];
            preg_match_all('/<!--[\s\S]*?-->|<\/?([a-zA-Z][a-zA-Z0-9:-]*)\b(?:[^>"\']|"[^"]*"|\'[^\']*\')*>/', $html, $matches, PREG_OFFSET_CAPTURE);

            foreach ($matches[0] as $index => [$tag, $position]) {
                $output .= substr($html, $offset, $position - $offset);
                $name = strtolower($matches[1][$index][0]);
                if ($name === '') {
                    $output .= $tag;
                } elseif (str_starts_with($tag, '</')) {
                    $depth = max(0, $depth - 1);
                    $output .= $tag;
                } else {
                    if ($depth === 0 && !preg_match('/\sdata-inherit-boundary(?:\s|=|\/?>)/i', $tag)) {
                        $tag = preg_replace('/\s*\/?>$/', ' data-inherit-boundary$0', $tag);
                    }
                    $output .= $tag;
                    if (!in_array($name, $voidElements, true) && !preg_match('/\/\s*>$/', $tag)) {
                        $depth++;
                    }
                }
                $offset = $position + strlen($matches[0][$index][0]);
            }

            return new HtmlString($output . substr($html, $offset));
        };
    }
}
