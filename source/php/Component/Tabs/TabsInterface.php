<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Tabs;

use ComponentLibrary\Component\ComponentInterface;

interface TabsInterface extends ComponentInterface
{
    /**
     * ID for the component.
     */
    public function getId(): string;

    /**
     * The tag for the component.
     */
    public function getComponentElement(): string;

    /**
     * List containing tabs with tab title and content.
     */
    public function getTabs(): array;

    /**
     * HeadingElement.
     */
    public function getHeadingElement(): string;

    /**
     * ContentElement.
     */
    public function getContentElement(): string;

}
