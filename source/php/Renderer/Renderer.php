<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer;

use HelsingborgStad\BladeService\BladeServiceInterface;
use Illuminate\View\ComponentSlot;

class Renderer implements RendererInterface
{
    public function __construct(
        private BladeServiceInterface $bladeService,
    ) {}

    public function render(string $view, array $data = []): string
    {
        try {
            $markup = $this->bladeService->makeView(
                $view,
                array_merge($this->normalizeComponentData($data), ['errorMessage' => false])
            )->render();
        } catch (\Throwable $e) {
            if (!defined('WP_DEBUG') || WP_DEBUG !== true) {
                throw $e;
            }

            $this->bladeService->errorHandler($e)->print();
            return '';
        }

        return $markup;
    }

    /**
     * Converts typed component data objects to the arrays required by Blade directives.
     *
     * @param mixed $value The data to normalize.
     * @return mixed
     */
    private function normalizeComponentData(mixed $value): mixed
    {
        if ($value instanceof ComponentSlot) {
            return $value;
        }

        if (is_array($value)) {
            foreach ($value as $key => $item) {
                $value[$key] = $this->normalizeComponentData($item);
            }

            return $value;
        }

        if (is_object($value)) {
            return $this->normalizeComponentData(get_object_vars($value));
        }

        return $value;
    }
}
