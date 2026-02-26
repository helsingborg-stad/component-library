<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Typography;

use ComponentLibrary\Component\ComponentInterface;

interface TypographyInterface extends ComponentInterface
{
    /**
     * What element the markup will use.
     */
    public function getElement(): string;

    /**
     * Headings (h1, h2...) can only be set to other headings. If left empty it will default to the given element.
     */
    public function getVariant(): bool;

    /**
     * The content.
     */
    public function getSlot(): string;

    /**
     * Upgrade element to h1 (from h3 and above), if seen first on page.
     */
    public function getAutopromote(): bool;

    /**
     * If a heading should be based off of the context its in.
     */
    public function getUseHeadingsContext(): bool;

}
