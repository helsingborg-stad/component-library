<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Pagination;

use ComponentLibrary\Component\ComponentInterface;

interface PaginationInterface extends ComponentInterface
{
    /**
     * Array with pages.
     */
    public function getList(): array;

    /**
     * current page as index number.
     */
    public function getCurrent(): int;

    /**
     * The current classname.
     */
    public function getCurrentClass(): string;

    /**
     * The tag for the component.
     */
    public function getComponentElement(): string;

    /**
     * List element tag.
     */
    public function getListElement(): string;

    /**
     * List item tag.
     */
    public function getListItem(): string;

    /**
     * Pagination uses a link prefix on prev next buttons before the numeric index, add it here.
     */
    public function getLinkPrefix(): string;

    /**
     * Adds the ability to add an anchor tag in the end of every link.
     */
    public function getAnchorTag(): string;

    /**
     * PreviousDisabled.
     */
    public function getPreviousDisabled(): string;

    /**
     * NextDisabled.
     */
    public function getNextDisabled(): string;

    /**
     * If the item should use default JS to supply pagination.
     */
    public function getUseJS(): bool;

    /**
     * When useJS is true, this option randomize the order of the items.
     */
    public function getRandomizeOrder(): bool;

    /**
     * How many items per page.
     */
    public function getPerPage(): int;

    /**
     * Maximum amount of pages.
     */
    public function getMaxPages(): bool;

    /**
     * The style of button to display.
     */
    public function getButtonStyle(): string;

    /**
     * Size of the buttons.
     */
    public function getButtonSize(): string;

    /**
     * Amount of pages that is shown to the user at one time.
     */
    public function getPagesToShow(): bool;

    /**
     * KeepDOM.
     */
    public function getKeepDOM(): bool;

}
