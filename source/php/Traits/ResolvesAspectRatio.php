<?php

namespace ComponentLibrary\Traits;

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
     * Applies a valid aspectRatio value as a component-namespaced CSS custom
     * property in the component's inline style attribute.
     *
     * The CSS variable name is derived from the component's base class, e.g.
     * --c-brand--aspect-ratio or --c-logotype--aspect-ratio. BaseController's
     * sanitizeInlineCss() will process the resulting style string automatically
     * during getData().
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

        $cssVar = '--' . $this->getBaseClass() . '--aspect-ratio';
        $existingStyle = trim((string) ($this->data['attributeList']['style'] ?? ''));
        if ($existingStyle !== '' && !str_ends_with($existingStyle, ';')) {
            $existingStyle .= ';';
        }

        $declaration = $cssVar . ': ' . $resolvedAspectRatio . ';';
        $this->data['attributeList']['style'] = trim(
            $existingStyle !== '' ? $existingStyle . ' ' . $declaration : $declaration
        );
        
        $this->data['attributeList']['data-aspect-ratio'] = $resolvedAspectRatio;
    }
}
