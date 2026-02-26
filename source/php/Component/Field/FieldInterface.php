<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Field;

use ComponentLibrary\Component\ComponentInterface;

interface FieldInterface extends ComponentInterface
{
    /**
     * Label for the field.
     */
    public function getLabel(): string;

    /**
     * text, checkbox and radio.
     */
    public function getType(): string;

    /**
     * Regular expression for validation. Will apply on non empty strings or all strings when required.
     */
    public function getValidationRegexp(): bool;

    /**
     * Message to display when the field is invalid.
     */
    public function getInvalidMessage(): bool;

    /**
     * Require this field to be filled in.
     */
    public function getRequired(): bool;

    /**
     * Browser automatically completes the input values based on values that the user has entered before. Reference: https://html.spec.whatwg.org/multipage/form-control-infrastructure.html#attr-fe-autocomplete.
     */
    public function getAutocomplete(): string;

    /**
     * Field value.
     */
    public function getValue(): string;

    /**
     * Adds a icon before the input field (string).
     */
    public function getIcon(array $icon, string $size): array|null;

    /**
     * Size.
     */
    public function getSize(): string;

    /**
     * If any special type of rounded corners should be used (none, xs, sm, md, lg).
     */
    public function getRadius(): string;

    /**
     * Example value for field.
     */
    public function getPlaceholder(): string;

    /**
     * This will remove the visible label. Label will be auditible for screen readers.
     */
    public function getHideLabel(): bool;

    /**
     * Text displayed below the field.
     */
    public function getHelperText(): string;

    /**
     * Render textarea instead of input. Boolean or number of rows to render.
     */
    public function getMultiline(): bool;

    /**
     * Removes the border around the input field.
     */
    public function getBorderless(): bool;

    /**
     * If the current theme applies shadows to element, append shadow here too.
     */
    public function getShadow(): bool;

    /**
     * Attributes for field element. Valid input attributes are casted to here from attributesList.
     */
    public function getFieldAttributeList(): array;

    /**
     * If we should move attributesList to fieldAttributeList automatically.
     */
    public function getMoveAttributesListToFieldAttributes(): bool;

    /**
     * Description for the field.
     */
    public function getDescription(): string;
}
