<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Table;

use ComponentLibrary\Component\ComponentInterface;

interface TableInterface extends ComponentInterface
{
    /**
     * Array of items.
     */
    public function getList(): array;

    /**
     * Array of items.
     */
    public function getHeadings(): array;

    /**
     * If header should be printed.
     */
    public function getShowHeader(): bool;

    /**
     * ShowCaption.
     */
    public function getShowCaption(): bool;

    /**
     * Renders a field for real time filtering.
     */
    public function getFilterable(): bool;

    /**
     * Makes each th a button that sorts corresponding cells in column.
     */
    public function getSortable(): bool;

    /**
     * Shows the sum of each column at the bottom of the table.
     */
    public function getShowSum(): bool;

    /**
     * Renders a button, that when clicked, makes the table fullscreen.
     */
    public function getFullscreen(): bool;

    /**
     * Makes the first column a second dimension of headers and locks in it place when scrolling. Also allows the user to collapse the first column.
     */
    public function getIsMultidimensional(): bool;

    /**
     * A title at above the table.
     */
    public function getTitle(): string;

    /**
     * IncludePaper.
     */
    public function getIncludePaper(): bool;

    /**
     * Label strings - replace for translation etc.
     */
    public function getLabels(): object;

}
