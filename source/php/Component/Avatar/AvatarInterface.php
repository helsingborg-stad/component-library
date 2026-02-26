<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Avatar;

use ComponentLibrary\Component\ComponentInterface;

interface AvatarInterface extends ComponentInterface
{
    /**
     * A url to a profile image or an ImageInterface.
     */
    public function getImage(): mixed;

    /**
     * Attributes for @icon component (separate reference).
     */
    public function getIcon(): array;

    /**
     * sm,md,lg,full.
     */
    public function getSize(): string;

}
