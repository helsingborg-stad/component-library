<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer;

use HelsingborgStad\BladeService\BladeServiceInterface;

class Renderer implements RendererInterface
{
    public function __construct(
        private BladeServiceInterface $bladeService,
    ) {}

    public function render(string $view, array $data = []): string
    {
        try {
            $markup = $this->bladeService->makeView($view, array_merge($data, ['errorMessage' => false]))->render();
        } catch (\Throwable $e) {
            if (!defined('WP_DEBUG') || WP_DEBUG !== true) {
                throw $e;
            }

            $this->bladeService->errorHandler($e)->print();
            return '';
        }

        return $markup;
    }
}
