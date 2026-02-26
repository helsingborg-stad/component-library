<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Loader;

use ComponentLibrary\Component\ComponentInterface;

interface LoaderInterface extends ComponentInterface
{
    /**
     * The tag for the component.
     */
    public function getComponentElement(): string;

    /**
     * Visual shape for the loader (circular, linear).
     */
    public function getShape(): string;

    /**
     * Size for the loader (xs, sm, md, lg, xl).
     */
    public function getSize(): string;

    /**
     * black, white, secondary, primary.
     */
    public function getColor(): string;

    /**
     * Loading text.
     */
    public function getText(): string;

}
