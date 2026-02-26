<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\InlineCssWrapper;

use ComponentLibrary\Component\ComponentInterface;

interface InlineCssWrapperInterface extends ComponentInterface
{
    /**
     * ComponentElement.
     */
    public function getComponentElement(): string;

    /**
     * Styles.
     */
    public function getStyles(): array;

}
