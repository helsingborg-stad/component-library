<?php

namespace ComponentLibrary\Component\Inheritboundry;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Helper\TagSanitizerInterface;
use Illuminate\Support\HtmlString;
use PHPUnit\Framework\TestCase;

class InheritboundryTest extends TestCase
{
    public function testMarksOnlyTopLevelElementsWithoutAddingAWrapper(): void
    {
        $component = new Inheritboundry([], $this->createMock(CacheInterface::class), $this->createMock(TagSanitizerInterface::class));
        $apply = $component->getData()['applyInheritBoundary'];
        $html = '<!-- comment --><img src="x"><div title="a > b"><span>Text</span></div><p data-inherit-boundary>More</p>';
        $this->assertSame('<!-- comment --><img src="x" data-inherit-boundary><div title="a > b" data-inherit-boundary><span>Text</span></div><p data-inherit-boundary>More</p>', $apply(new HtmlString($html))->toHtml());
    }
}
