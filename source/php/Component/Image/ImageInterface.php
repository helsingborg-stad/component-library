<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Image;

use ComponentLibrary\Component\ComponentInterface;

interface ImageInterface extends ComponentInterface
{
    /**
     * A string containing a valid URL or an ImageInterface object. If the object is used, the srcset attribute is ignored.
     */
    public function getSrc(): mixed;

    /**
     * A string containing a valid srcset attribute. Ignored if src is an ImageInterface object.
     */
    public function getSrcset(): bool|string|null;

    /**
     * Alt text of the imag. May override the alt text of the ImageInterface object.
     */
    public function getAlt(): null|string;

    /**
     * Image caption. That will be visible for the user. .
     */
    public function getCaption(): string|bool;

    /**
     * Removes the visible caption. The caption may still be used as an alt-text for the image.
     */
    public function getRemoveCaption(): bool;

    /**
     * Byline for additional information, placed under the caption.
     */
    public function getByline(): null|string;

    /**
     * If the image should obtain the --full-width modifier.
     */
    public function getFullWidth(): bool;

    /**
     * If the image should obtain the --cover modifier.
     */
    public function getCover(): bool;

    /**
     * Border radius of the image, false for no radius. Accepted values are xs, sm, md, lg, full (circle).
     */
    public function getRounded(): bool;

    /**
     * If the placeholder should be enabled, if false, the component will not render at all if the src is empty.
     */
    public function getPlaceholderEnabled(): bool;

    /**
     * Label to show if image is missing.
     */
    public function getPlaceholderText(): string|bool;

    /**
     * Icon to display if image is missing / false to hide.
     */
    public function getPlaceholderIcon(): string;

    /**
     * Icons size, please refer to image component for size.
     */
    public function getPlaceholderIconSize(): string;

    /**
     * Attributes for the img element.
     */
    public function getImgAttributeList(): array;

    /**
     * If the low quality image placeholder should be enabled.
     */
    public function getLqipEnabled(): bool;

    /**
     * If the aspect ratio should be calculated based on the image dimensions. This option will be ignored if cover is set to true.
     */
    public function getCalculateAspectRatio(): bool;
}
