<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Link;

/**
 * Typed input contract for the Link component.
 */
final class LinkData
{
    /**
     * @param string $componentElement The wrapper element.
     * @param string $slot The fallback slot content.
     * @param string|null $href The target URL.
     * @param string $target The link target.
     * @param bool $keepContent Whether to keep the content when href is empty.
     * @param bool $keepWrapper Whether to keep the wrapper when href is empty.
     * @param string|null $xfn Optional rel attribute value.
     * @param bool $unstyled Whether to disable component styling.
     */
    public function __construct(
        public string $componentElement = 'span',
        public string $slot = 'Undefined label',
        public ?string $href = null,
        public string $target = '_top',
        public bool $keepContent = true,
        public bool $keepWrapper = true,
        public ?string $xfn = null,
        public bool $unstyled = false,
    ) {
    }
}
