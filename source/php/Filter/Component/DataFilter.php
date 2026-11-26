<?php

namespace ComponentLibrary\Filter\Component;

use ComponentLibrary\Component\BaseController;

/** Applies the data and language hooks used before component initialization. */
final class DataFilter extends AbstractComponentFilter
{
    /** @param callable $synchronize Reconciles the filtered data with its previous state. */
    public function __construct(
        private BaseController $component,
        private string $filterName,
        private $synchronize,
    ) {}

    /** @inheritDoc */
    protected function filter(array $value): array
    {
        $before = $value;
        $value = apply_filters('ComponentLibrary/Component/Data', $value, $this->component);
        $value = ($this->synchronize)($value, $before);

        $before = $value;
        $value = apply_filters($this->filterName . DIRECTORY_SEPARATOR . 'Data', $value);
        $value = ($this->synchronize)($value, $before);
        $value['lang'] = apply_filters('ComponentLibrary/Component/Lang', $value['lang'] ?? []);

        return $value;
    }
}
