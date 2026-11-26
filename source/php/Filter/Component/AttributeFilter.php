<?php

namespace ComponentLibrary\Filter\Component;

/** Applies the existing component attribute hooks in their original order. */
final class AttributeFilter extends AbstractComponentFilter
{
    public function __construct(private string $filterName) {}

    /** @inheritDoc */
    protected function filter(array $value): array
    {
        $value = apply_filters($this->filterName . DIRECTORY_SEPARATOR . 'Attribute', $value);
        return apply_filters('ComponentLibrary/Component/Attribute', $value);
    }
}
