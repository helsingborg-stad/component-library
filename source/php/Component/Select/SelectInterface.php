<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Select;

use ComponentLibrary\Component\ComponentInterface;

interface SelectInterface extends ComponentInterface
{
    /**
     * The placeholder of the dropdown.
     */
    public function getLabel(): string;

    /**
     * Supported if multiple select is enabled.
     */
    public function getPlaceholder(): string;

    /**
     * The id attribute for the select component. Will be prefixed with "select_".
     */
    public function getId(): bool;

    /**
     * Additional description or instructions.
     */
    public function getDescription(): string;

    /**
     * If the element should be required.
     */
    public function getRequired(): bool;

    /**
     * The options which can be selected. The key if the item will be used as value of the option and the value will be used as a label.
     */
    public function getOptions(): array;

    /**
     * ErrorMessage.
     */
    public function getErrorMessage(): bool;

    /**
     * Key of option to be preselected.
     */
    public function getPreselected(): bool;

    /**
     * Sets the select box to a multiple select.
     */
    public function getMultiple(): bool;

    /**
     * Hides the label.
     */
    public function getHideLabel(): bool;

    /**
     * Adds a helping text, below the element.
     */
    public function getHelperText(): string;

    /**
     * The size of the select component (sm, md, lg).
     */
    public function getSize(): string;

    /**
     * The maximum number of selections allowed. Will only be applied if "multiple" is true.
     */
    public function getMaxSelections(): bool;

    /**
     * Hides the placeholder but keeps the label.
     */
    public function getHidePlaceholder(): bool;

    /**
     * Ann array with attributes that will be set on the actual select element.
     */
    public function getSelectAttributeList(): array;

    /**
     * Enables a search input within the select dropdown.
     */
    public function getSearch(): mixed;

    /**
     * The placeholder text for the search input.
     */
    public function getSearchPlaceholder(): string;

    /**
     * The text to show when no results are found in the search.
     */
    public function getSearchNoResultsText(): string;

}
