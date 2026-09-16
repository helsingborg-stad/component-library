<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Table__cell;

/**
 * Typed input contract for the Table cell component.
 */
final class TableCellData
{
    public function __construct(
        public string $componentElement = 'td',
        public ?int $index = null,
    ) {
    }
}
