<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Footer;

use ComponentLibrary\Component\ComponentInterface;

interface FooterInterface extends ComponentInterface
{
    /**
     * The element tag to render.
     */
    public function getComponentElement(): string;

    /**
     * Set to true will enable only slot area.
     */
    public function getSlotOnly(): bool;

    /**
     * Custom container id.
     */
    public function getId(): string;

    /**
     * Footer logotype url.
     */
    public function getLogotype(): string;

    /**
     * The url to link the logotype to.
     */
    public function getLogotypeHref(): string;

    /**
     * Links.
     */
    public function getLinks(): array;

    /**
     * Subfooter logotype url.
     */
    public function getSubfooterLogotype(): string;

    /**
     * Arbitrary HTML placed before the main footer content. Wrapped in container and 12col grid.
     */
    public function getPrefooter(): string;

    /**
     * Arbitrary HTML placed after the main footer content. Wrapped in container and 12col grid.
     */
    public function getPostfooter(): string;

    /**
     * Arbitrary HTML content. Wrapped in container and 12col grid.
     */
    public function getFooterareas(): string;

}
