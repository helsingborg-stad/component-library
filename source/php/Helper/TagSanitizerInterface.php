<?php

namespace ComponentLibrary\Helper;

interface TagSanitizerInterface
{
    /**
     * Sanitize the content by removing links.
     *
     * @param string $string
     *
     * @return string
     */
    public function removeATags(string $string): string;
}