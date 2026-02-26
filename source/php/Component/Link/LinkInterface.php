<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Link;

use ComponentLibrary\Component\ComponentInterface;

interface LinkInterface extends ComponentInterface
{
    /**
     * ComponentElement.
     */
    public function getComponentElement(): string;

    /**
     * The content of the link.
     */
    public function getSlot(): string;

    /**
     * Where should the link go to?.
     */
    public function getHref(): string;

    /**
     * Link target attribute. Default is _top. Allowed values are _blank, _self, _parent or _top. This is only added if href is not empty.
     */
    public function getTarget(): string;

    /**
     * If link is empty, should we show content anyways? Prints the content wrazpped by a span element.
     */
    public function getKeepContent(): bool;

    /**
     * If link is empty and keepContent is true, should we keep the span added by keepContent? If false, it will print the content without any wrapping element.
     */
    public function getKeepWrapper(): bool;

    /**
     * Relation to the link (ex. nofollow).
     */
    public function getXfn(): bool;

    /**
     * If true, all link styles will use inherit from parent element.
     */
    public function getUnstyled(): bool;

}
