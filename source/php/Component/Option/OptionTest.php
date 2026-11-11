<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Option;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use ComponentLibrary\Helper\TagSanitizerInterface;
use ComponentLibrary\Renderer\BladeService\BladeServiceCreator;
use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase
{
    public function testDefaultsLeaveMarkupDataUnchanged(): void
    {
        $data = $this->getData(['label' => 'Yes']);

        static::assertNotContains('c-option--card', $data['classList']);
        static::assertSame('label_opt', $data['labelTextId']);
        static::assertFalse($data['hasLabelExtras']);
        static::assertNull($data['stateIndicator']);
        static::assertArrayNotHasKey('aria-describedby', $data['attributeList']);
    }

    public function testCardAppearanceAddsModifierClass(): void
    {
        $data = $this->getData(['label' => 'Yes', 'appearance' => 'card']);

        static::assertContains('c-option--card', $data['classList']);
        static::assertStringContainsString('c-option--card', $data['class']);
    }

    public function testUnknownAppearanceFallsBackToDefault(): void
    {
        $data = $this->getData(['label' => 'Yes', 'appearance' => 'tile']);

        static::assertNotContains('c-option--card', $data['classList']);
    }

    public function testDescriptionAndStateIndicatorAreLinkedToTheInput(): void
    {
        $data = $this->getData([
            'label' => 'Yes',
            'description' => 'A small shed',
            'stateIndicator' => ['text' => 'No permit', 'state' => 'success'],
            'attributeList' => ['aria-describedby' => 'help'],
        ]);

        static::assertTrue($data['hasLabelExtras']);
        static::assertSame('label_opt_text', $data['labelTextId']);
        static::assertSame('description_opt', $data['descriptionId']);
        static::assertSame('state_opt', $data['stateIndicator']['id']);
        static::assertSame('c-option__aside c-option__aside--success', $data['stateIndicator']['class']);
        static::assertSame('help description_opt state_opt', $data['attributeList']['aria-describedby']);
    }

    public function testRendersDefaultMarkupWithoutExtras(): void
    {
        $html = $this->render(['label' => 'Up to <b>15</b> m²', 'type' => 'radio']);

        static::assertStringContainsString('aria-labelledby="label_opt"', $html);
        static::assertStringContainsString(
            '<span id="label_opt" class="c-option__radio--label-text">Up to <b>15</b> m²</span>',
            $html,
        );
        static::assertStringNotContainsString('c-option__description', $html);
        static::assertStringNotContainsString('c-option__aside', $html);
        static::assertStringNotContainsString('aria-describedby', $html);
    }

    public function testRendersCardWithEscapedDescriptionAndStateIndicator(): void
    {
        $html = $this->render([
            'type' => 'radio',
            'label' => 'Up to 15 m²',
            'appearance' => 'card',
            'description' => 'A shed <em>or</em> playhouse',
            'stateIndicator' => ['text' => 'No <permit>', 'state' => 'success'],
        ]);

        static::assertStringContainsString('c-option--card', $html);
        static::assertStringContainsString('aria-labelledby="label_opt_text"', $html);
        static::assertStringContainsString('aria-describedby="description_opt state_opt"', $html);
        static::assertMatchesRegularExpression(
            '#<span id="label_opt" class="c-option__radio--label-text">\s*'
            . '<span id="label_opt_text">Up to 15 m²</span>\s*'
            . '<span id="description_opt" class="c-option__description">A shed &lt;em&gt;or&lt;/em&gt; playhouse</span>\s*'
            . '<span id="state_opt" class="c-option__aside c-option__aside--success">No &lt;permit&gt;</span>\s*'
            . '</span>#',
            $html,
        );
    }

    private function getData(array $input): array
    {
        $data = array_merge(
            (new ComponentDataReflector())->getDefaultArguments(OptionData::class),
            ['id' => 'opt'],
            $input,
        );

        $option = new Option(
            $data,
            new class implements CacheInterface {
                public function get(string $key, ?string $group = null): mixed
                {
                    return null;
                }

                public function set(string $key, mixed $data, ?string $group = null): void {}
            },
            new class implements TagSanitizerInterface {
                public function removeATags(string $string): string
                {
                    return strip_tags($string, '<a>');
                }
            },
        );

        return $option->getData();
    }

    private function render(array $input): string
    {
        $blade = (new BladeServiceCreator())->create([__DIR__]);
        $blade->registerDirective('icon', static fn(): string => '');
        $blade->registerDirective('endicon', static fn(): string => '');

        return $blade->makeView('option', $this->getData($input))->render();
    }
}
