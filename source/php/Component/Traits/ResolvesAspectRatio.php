<?php

namespace ComponentLibrary\Component\Traits;

trait ResolvesAspectRatio
{
    /**
     * Resolves and validates an aspectRatio value.
     *
     * Accepts a positive number or a numeric string greater than zero.
     * Returns the value as a string suitable for the CSS aspect-ratio property,
     * or null when the value is absent or invalid.
     *
     * @param mixed $value
     *
     * @return string|null
     */
    public function resolveAspectRatio($value): ?string
    {
        if ($value === null || $value === false || $value === '') {
            return null;
        }

        if (!is_numeric($value)) {
            return null;
        }

        $numeric = (float) $value;
        if ($numeric <= 0) {
            return null;
        }

        return (string) $value;
    }

    /**
     * Applies a valid aspectRatio value as a CSS inline style on the component.
     *
     * Merges the aspect-ratio declaration into the existing attributeList style
     * value, ensuring the existing style is properly terminated with a semicolon
     * before appending.
     *
     * @param mixed $aspectRatio
     *
     * @return void
     */
    protected function applyAspectRatioStyle($aspectRatio): void
    {
        $resolvedAspectRatio = $this->resolveAspectRatio($aspectRatio);
        if ($resolvedAspectRatio === null) {
            return;
        }

        if (!isset($this->data['attributeList']) || !is_array($this->data['attributeList'])) {
            $this->data['attributeList'] = [];
        }

        $existingStyle = trim((string) ($this->data['attributeList']['style'] ?? ''));
        if ($existingStyle !== '' && !str_ends_with($existingStyle, ';')) {
            $existingStyle .= ';';
        }

        $aspectRatioStyle = 'aspect-ratio: ' . $resolvedAspectRatio . ';';
        $this->data['attributeList']['style'] = trim(
            $existingStyle !== '' ? $existingStyle . ' ' . $aspectRatioStyle : $aspectRatioStyle
        );
    }
}
