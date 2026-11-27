<?php

namespace ComponentLibrary\Filter\Component;

/** Applies modifier and class hooks in their original order. */
final class ClassFilter extends AbstractComponentFilter
{
    public function __construct(
        private string $componentName,
        private string $baseClass,
        private array $context,
    ) {}

    /** @inheritDoc */
    protected function filter(array $value): array
    {
        foreach (['ComponentLibrary/Component/Modifier', 'ComponentLibrary/Component/' . $this->componentName . '/Modifier'] as $hook) {
            foreach (apply_filters($hook, [], $this->context) as $modifier) {
                if ($modifier && is_string($modifier)) {
                    $value[] = $this->baseClass . '--' . $modifier;
                }
            }
        }

        $value = apply_filters('ComponentLibrary/Component/Class', $value);
        return apply_filters('ComponentLibrary/Component/' . $this->componentName . '/Class', $value, $this->context);
    }
}
