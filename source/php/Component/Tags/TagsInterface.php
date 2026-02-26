<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Tags;

use ComponentLibrary\Component\ComponentInterface;

interface TagsInterface extends ComponentInterface
{
    /**
     * Style.
     */
    public function getStyle(): string;

    /**
     * .
     */
    public function getComponentElement(): string;

    /**
     * .
     */
    public function getBeforeLabel(): string;

    /**
     * Same specification as Icon, adds an icon .
     */
    public function getIcon(): array;

    /**
     * .
     */
    public function getAfterLabel(): string;

    /**
     * If the component should format the input text.
     */
    public function getFormat(): bool;

    /**
     * Show [N] amount of items, hide the rest of them behind a expand indicator.
     */
    public function getCompress(): bool;

}
