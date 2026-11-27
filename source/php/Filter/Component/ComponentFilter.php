<?php

namespace ComponentLibrary\Filter\Component;

/** A filter pipeline that transforms a component data list. */
interface ComponentFilter
{
    /**
     * @param array $value Component data to filter.
     * @param bool $enabled Whether to run the WordPress hooks.
     * @return array Filtered data, or the original data when disabled.
     */
    public function apply(array $value, bool $enabled = true): array;
}
