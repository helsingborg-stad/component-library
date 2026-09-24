<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer;

class VendorDeprecationSilencer
{
    /**
     * Runs a callback while suppressing PHP 8.4 deprecations emitted by legacy vendor signatures.
     *
     * @param callable $callback
     * @return mixed
     */
    public function run(callable $callback): mixed
    {
        $previousErrorHandler = null;
        $previousErrorHandler = set_error_handler(
            static function (int $severity, string $message, string $file, int $line) use (&$previousErrorHandler): bool {
                if ($severity === E_DEPRECATED && str_contains($file, DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR)) {
                    return true;
                }

                if (is_callable($previousErrorHandler)) {
                    return $previousErrorHandler($severity, $message, $file, $line);
                }

                return false;
            },
        );

        try {
            return $callback();
        } finally {
            restore_error_handler();
        }
    }
}