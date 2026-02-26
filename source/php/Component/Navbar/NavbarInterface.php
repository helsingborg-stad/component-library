<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Navbar;

use ComponentLibrary\Component\ComponentInterface;

interface NavbarInterface extends ComponentInterface
{
    /**
     * A link to a logo.
     */
    public function getLogo(): string;

    /**
     * An array of links.
     */
    public function getItems(): array;

    /**
     * If set to true the toggle will toggle sidebar.
     */
    public function getSidebar(): bool;

    /**
     * Data for expanded menu.
     */
    public function getExpandedMenu(): bool;

    /**
     * IsDynamic.
     */
    public function getIsDynamic(): bool;

}
