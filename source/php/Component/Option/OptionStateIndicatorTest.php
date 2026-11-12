<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Option;

use PHPUnit\Framework\TestCase;

class OptionStateIndicatorTest extends TestCase
{
    /**
     * @dataProvider stateProvider
     */
    public function testNormalizesState(array $input, string $expectedState, string $expectedClass): void
    {
        $indicator = OptionStateIndicator::normalize(['text' => ' Tag '] + $input, 'opt');

        static::assertSame(
            ['text' => 'Tag', 'state' => $expectedState, 'id' => 'state_opt', 'class' => $expectedClass],
            $indicator,
        );
    }

    public static function stateProvider(): array
    {
        return [
            'missing state is neutral' => [[], 'neutral', 'c-option__aside'],
            'neutral' => [['state' => 'neutral'], 'neutral', 'c-option__aside'],
            'success' => [['state' => 'success'], 'success', 'c-option__aside c-option__aside--success'],
            'warning' => [['state' => 'warning'], 'warning', 'c-option__aside c-option__aside--warning'],
            'danger' => [['state' => 'danger'], 'danger', 'c-option__aside c-option__aside--danger'],
            'unknown is neutral' => [['state' => '"><script>'], 'neutral', 'c-option__aside'],
        ];
    }

    /**
     * @dataProvider emptyProvider
     */
    public function testReturnsNullWithoutText(mixed $input): void
    {
        static::assertNull(OptionStateIndicator::normalize($input, 'opt'));
    }

    public static function emptyProvider(): array
    {
        return [
            'null' => [null],
            'empty array' => [[]],
            'string' => ['Stop'],
            'state only' => [['state' => 'danger']],
            'blank text' => [['text' => '  ', 'state' => 'danger']],
        ];
    }
}
