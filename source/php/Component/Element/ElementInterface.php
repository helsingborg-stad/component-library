<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Element;

use ComponentLibrary\Component\ComponentInterface;

interface ElementInterface extends ComponentInterface
{
    /**
     * The tag to use for this component.
     */
    public function getComponentElement(): string;

    /**
     * If true, the component will not be rendered if there is no content.
     */
    public function getHideIfNoContent(): bool;

}
