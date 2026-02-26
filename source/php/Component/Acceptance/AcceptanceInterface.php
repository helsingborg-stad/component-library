<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Acceptance;

use ComponentLibrary\Component\ComponentInterface;

interface AcceptanceInterface extends ComponentInterface
{
    /**
     * Object or array containing knownLabels and unknownLabels with title, info, and button.
     */
    public function getLabels(): mixed;

    /**
     * height in number ex 500.
     */
    public function getHeight(): bool|string;

    /**
     * array of urls to hide ex. https://www.youtube.com.
     */
    public function getSrc(): bool|array;

    /**
     * URL to third party website policy.
     */
    public function getPolicy(): bool;

    /**
     * host ex. youtube.com.
     */
    public function getHost(): bool;

    /**
     * Icon name as a string.
     */
    public function getIcon(): string;

    /**
     * URL for background image.
     */
    public function getCover(): bool;

    /**
     * Modifier variable ex. video.
     */
    public function getModifier(): string;

}
