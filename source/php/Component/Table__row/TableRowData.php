<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Table__row;

/**
 * Typed input contract for the Table row component.
 */
final class TableRowData
{
    public function __construct(
        public ?int $index = null,
        public bool $isSummary = false,
    ) {}
}
