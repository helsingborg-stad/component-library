<?php

namespace ComponentLibrary\Filter\Component;

/** Runs component hooks only when enabled and WordPress is available. */
abstract class AbstractComponentFilter implements ComponentFilter
{
    /** @inheritDoc */
    final public function apply(array $value, bool $enabled = true): array
    {
        if (!$enabled || !function_exists('apply_filters')) {
            return $value;
        }

        return $this->filter($value);
    }

    /** @param array $value Component data to filter. @return array Filtered data. */
    abstract protected function filter(array $value): array;
}
