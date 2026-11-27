<?php

namespace ComponentLibrary\Filter\Component;

/** Applies component-specific filters to each eligible view data field. */
final class FieldFilter extends AbstractComponentFilter
{
    /** @param callable $synchronize Reconciles the filtered data with its previous state. */
    public function __construct(private string $filterName, private $synchronize) {}

    /** @inheritDoc */
    protected function filter(array $value): array
    {
        foreach ($value as $key => $item) {
            if (in_array($key, ['data', 'classes', 'class'], true)) {
                continue;
            }
            $before = $value;
            $value[$key] = apply_filters(
                $this->filterName . DIRECTORY_SEPARATOR . ucfirst($key),
                $value[$key],
                $value['context'] ?? [],
            );
            $value = ($this->synchronize)($value, $before);
        }

        return $value;
    }
}
