<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Drawer;

use ComponentLibrary\Component\ComponentInterface;

interface DrawerInterface extends ComponentInterface
{
    /**
     * What to say in the label of the close drawer button.
     */
    public function getLabel(): string;

    /**
     * Show on selected screen sizes. xs,sm,md,lg,xl.
     */
    public function getScreenSizes(): array;

    /**
     * The data to be passed to the toggle button. If empty no button will be rendered.
     */
    public function getToggleButtonData(): array;

}
