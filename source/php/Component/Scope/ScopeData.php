<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Scope;

/**
 * Typed input contract for the Scope component.
 */
final class ScopeData
{
    public function __construct(
        public string|array $name = '',
    ) {
    }
}
