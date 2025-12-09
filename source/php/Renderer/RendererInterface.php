<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer;

interface RendererInterface
{
    public function render(string $view, array $data = []): string;
}
