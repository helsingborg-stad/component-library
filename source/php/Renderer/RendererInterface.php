<?php

namespace ComponentLibrary\Renderer;

interface RendererInterface {
    public function render(string $view, array $data = []): string;
}