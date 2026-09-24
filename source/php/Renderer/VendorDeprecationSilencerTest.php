<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer;

use PHPUnit\Framework\TestCase;

class VendorDeprecationSilencerTest extends TestCase
{
    /**
     * @testdox it returns the callback result
     */
    public function testReturnsCallbackResult(): void
    {
        $result = (new VendorDeprecationSilencer())->run(
            static fn (): string => 'rendered',
        );

        static::assertSame('rendered', $result);
    }

    /**
     * @testdox it restores error reporting after a successful callback
     */
    public function testRestoresErrorReportingAfterSuccess(): void
    {
        $originalErrorReporting = error_reporting();
        error_reporting(E_ALL);

        try {
            (new VendorDeprecationSilencer())->run(static fn (): string => 'rendered');

            static::assertSame(E_ALL, error_reporting());
        } finally {
            error_reporting($originalErrorReporting);
        }
    }

    /**
     * @testdox it restores error reporting after a failed callback
     */
    public function testRestoresErrorReportingAfterFailure(): void
    {
        $originalErrorReporting = error_reporting();
        error_reporting(E_ALL);

        try {
            try {
                (new VendorDeprecationSilencer())->run(
                    static function (): void {
                        throw new \RuntimeException('Failed callback');
                    },
                );
            } catch (\RuntimeException) {
                static::assertSame(E_ALL, error_reporting());
            }
        } finally {
            error_reporting($originalErrorReporting);
        }
    }

    /**
     * @testdox it passes application deprecations to the previous error handler
     */
    public function testPassesApplicationDeprecationsToPreviousErrorHandler(): void
    {
        $handledDeprecation = false;
        set_error_handler(
            static function (int $severity) use (&$handledDeprecation): bool {
                $handledDeprecation = $severity === E_USER_DEPRECATED;
                return true;
            },
        );

        try {
            (new VendorDeprecationSilencer())->run(
                static function (): void {
                    trigger_error('Application deprecation', E_USER_DEPRECATED);
                },
            );
        } finally {
            restore_error_handler();
        }

        static::assertTrue($handledDeprecation);
    }
}