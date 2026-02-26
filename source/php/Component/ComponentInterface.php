<?php

declare(strict_types=1);

namespace ComponentLibrary\Component;

interface ComponentInterface
{
    public function getSlug(): string;
    public function getName(): string;
    public function getData(): array;
}
