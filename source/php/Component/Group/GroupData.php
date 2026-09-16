<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Group;

/**
 * Typed input contract for the Group component.
 */
final class GroupData
{
    public function __construct(
        public string $direction = 'horizontal',
        public string $justifyContent = '',
        public string $jusitifyContent = '',
        public string $alignItems = '',
        public string $alignContent = '',
        public string $display = '',
        public string $wrap = '',
        public bool $flexGrow = false,
        public bool $flexShrink = true,
        public string $gap = '',
        public int|string|bool|null $fluidGrid = null,
        public int|string|null $columns = null,
        public bool $normalizeChildren = true,
        public bool $fullWidth = false,
    ) {
        if ($this->justifyContent === '' && $this->jusitifyContent !== '') {
            $this->justifyContent = $this->jusitifyContent;
        }

        if ($this->jusitifyContent === '' && $this->justifyContent !== '') {
            $this->jusitifyContent = $this->justifyContent;
        }
    }
}
