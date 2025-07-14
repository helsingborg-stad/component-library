<?php

namespace ComponentLibrary\Helper;

class TagSanitizer implements TagSanitizerInterface
{
    /**
     * Sanitize the excerpt by removing links.
     *
     * @param string $excerpt
     *
     * @return string
     */
    public function removeATags(string $string): string {
        return preg_replace('/<a\b[^>]*>(.*?)<\/a>/is', '$1', $string);
    }
}