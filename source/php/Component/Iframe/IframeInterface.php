<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Iframe;

use ComponentLibrary\Component\ComponentInterface;

interface IframeInterface extends ComponentInterface
{
    /**
     * Source URL.
     */
    public function getSrc(): string;

    /**
     * Loading type (for defering).
     */
    public function getLoading(): string;

    /**
     * Width in number or % (ex: 100% or 400).
     */
    public function getWidth(): string;

    /**
     * Height in number.
     */
    public function getHeight(): string;

    /**
     * Default border of the iframe (0 for none, 1 for border).
     */
    public function getFrameborder(): string;

    /**
     * JSON string of an object containing button, title and info labels.
     */
    public function getLabels(): string;

    /**
     * Modifier variable ex. video.
     */
    public function getModifier(): string;

    /**
     * Title.
     */
    public function getTitle(): string;

    /**
     * Poster.
     */
    public function getPoster(): bool;

}
