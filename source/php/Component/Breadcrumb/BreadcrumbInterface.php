<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Breadcrumb;

use ComponentLibrary\Component\ComponentInterface;

interface BreadcrumbInterface extends ComponentInterface
{
    /**
     * Array of breadcrumb items.
     */
    public function getList(): array;

    /**
     * The aria-label of the component.
     */
    public function getLabel(): string;

    /**
     * What element to wrap this component with.
     */
    public function getComponentElement(): string;

    /**
     * The list type ol/ul.
     */
    public function getListType(): string;

    /**
     * The item type: li.
     */
    public function getListItemType(): string;

    /**
     * The label before the breadcrumb items (screen reader only).
     */
    public function getPrefixLabel(): string;

    /**
     * The number of letters until item is truncated.
     */
    public function getTruncate(): int|bool;

}
