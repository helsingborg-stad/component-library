<?php

/**
 * CollapsiblesearchTest
 *
 * Tests for the Collapsiblesearch component controller.
 */
class CollapsiblesearchTest extends PHPUnit\Framework\TestCase
{
    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Build component data by merging JSON defaults with the provided overrides.
     *
     * @param array $overrides
     * @return array
     */
    private function getComponentData(array $overrides = []): array
    {
        $jsonFile = file_get_contents(
            'source/php/Component/Collapsiblesearch/collapsiblesearch.json',
            true,
        );
        $json = json_decode($jsonFile, true);

        return array_merge($json['default'], $overrides);
    }

    /**
     * Instantiate the component and return its data array.
     *
     * @param array $overrides
     * @return array
     */
    private function make(array $overrides = []): array
    {
        $data = $this->getComponentData($overrides);
        $component = new \ComponentLibrary\Component\Collapsiblesearch\Collapsiblesearch(
            $data,
            new \ComponentLibrary\Cache\StaticCache(),
            new \ComponentLibrary\Helper\TagSanitizer(),
        );

        return $component->getData();
    }

    // -------------------------------------------------------------------------
    // Base class / rendering
    // -------------------------------------------------------------------------

    public function testBaseClassIsHyphenated(): void
    {
        $data = $this->make();
        $this->assertEquals('c-collapsiblesearch', $data['baseClass']);
    }

    public function testUidIsGenerated(): void
    {
        $data = $this->make();
        $this->assertNotEmpty($data['uid']);
    }

    public function testWrapperHasDataAttribute(): void
    {
        $data = $this->make();
        $this->assertArrayHasKey('data-js-collapsible-search', $data['attributeList']);
    }

    public function testWrapperUsesThePublicComponentName(): void
    {
        $data = $this->make();
        $this->assertEquals('collapsiblesearch', $data['attributeList']['data-component']);
    }

    // -------------------------------------------------------------------------
    // Expanded state
    // -------------------------------------------------------------------------

    public function testExpandedModifierClassIsAbsentByDefault(): void
    {
        $data = $this->make();
        $this->assertNotContains('c-collapsiblesearch--expanded', $data['classList']);
    }

    public function testExpandedModifierClassIsAddedWhenIsExpandedTrue(): void
    {
        $data = $this->make(['isExpanded' => true]);
        $this->assertContains('c-collapsiblesearch--expanded', $data['classList']);
    }

    // -------------------------------------------------------------------------
    // Trigger button pass-through
    // -------------------------------------------------------------------------

    public function testTriggerButtonDataContainsTriggerDataAttribute(): void
    {
        $data = $this->make();
        $this->assertArrayHasKey(
            'data-js-collapsible-search-trigger',
            $data['button']['attributeList'],
        );
    }

    public function testTriggerAriaExpandedIsFalseByDefault(): void
    {
        $data = $this->make();
        $this->assertEquals('false', $data['button']['attributeList']['aria-expanded']);
    }

    public function testTriggerAriaExpandedIsTrueWhenExpanded(): void
    {
        $data = $this->make(['isExpanded' => true]);
        $this->assertEquals('true', $data['button']['attributeList']['aria-expanded']);
    }

    public function testTriggerAriaControlsReferencesPanel(): void
    {
        $data = $this->make();
        $uid = $data['uid'];
        $this->assertEquals($uid . '-panel', $data['button']['attributeList']['aria-controls']);
    }

    public function testCallerButtonParamsArePreserved(): void
    {
        $data = $this->make(['button' => ['text' => 'Find it', 'color' => 'primary', 'size' => 'lg']]);
        $this->assertEquals('Find it', $data['button']['text']);
        $this->assertEquals('primary', $data['button']['color']);
        $this->assertEquals('lg', $data['button']['size']);
    }

    public function testCallerAttributeListIsMergedOntoButton(): void
    {
        $data = $this->make(['button' => ['attributeList' => ['data-custom' => 'yes']]]);
        $this->assertArrayHasKey('data-custom', $data['button']['attributeList']);
    }

    public function testCallerAttributeListDoesNotOverrideAriaExpanded(): void
    {
        // aria-expanded is always set by the component; callers cannot override it.
        $data = $this->make(['button' => ['attributeList' => ['aria-expanded' => 'true']]]);
        $this->assertEquals('false', $data['button']['attributeList']['aria-expanded']);
    }

    public function testComponentElementIsAlwaysButton(): void
    {
        $data = $this->make(['button' => ['componentElement' => 'a']]);
        $this->assertEquals('button', $data['button']['componentElement']);
    }

    // -------------------------------------------------------------------------
    // Search-specific defaults
    // -------------------------------------------------------------------------

    public function testDefaultPlaceholderIsSet(): void
    {
        $data = $this->make();
        $this->assertNotEmpty($data['placeholder']);
    }

    public function testDefaultInputNameIsSet(): void
    {
        $data = $this->make();
        $this->assertNotEmpty($data['inputName']);
    }

    public function testCustomPlaceholderIsPassedThrough(): void
    {
        $data = $this->make(['placeholder' => 'Type here…']);
        $this->assertEquals('Type here…', $data['placeholder']);
    }
}
