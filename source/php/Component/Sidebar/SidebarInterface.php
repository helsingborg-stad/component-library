<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Sidebar;

use ComponentLibrary\Component\ComponentInterface;

interface SidebarInterface extends ComponentInterface
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
     * Option to display the button to hide sidebar, otherwise just clicking outside the drawer will close it.
     */
    public function getShowHideButton(): bool;

}
