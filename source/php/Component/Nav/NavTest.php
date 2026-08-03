<?php

namespace ComponentLibrary\Component\Nav;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Helper\TagSanitizerInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class NavTest
 *
 * Unit tests covering hasChildren and hasToggle decision paths in the Nav
 * component, as well as integration-level tests for toggle presence/absence.
 *
 * @package ComponentLibrary\Component\Nav
 */
class NavTest extends TestCase
{
    // -------------------------------------------------------------------------
    // normalizeItems – hasChildren
    // -------------------------------------------------------------------------

    /**
     * @testdox hasChildren is false when children is false (leaf item)
     */
    public function testHasChildrenIsFalseForLeafItem(): void
    {
        $nav   = $this->createNav(['includeToggle' => true]);
        $items = $nav->normalizeItems([['children' => false]]);

        $this->assertFalse($items[0]['hasChildren']);
    }

    /**
     * @testdox hasChildren is true for a non-empty children array
     */
    public function testHasChildrenIsTrueForNonEmptyArray(): void
    {
        $nav   = $this->createNav(['includeToggle' => true]);
        $items = $nav->normalizeItems([
            ['children' => [['label' => 'Child One']]],
        ]);

        $this->assertTrue($items[0]['hasChildren']);
    }

    /**
     * @testdox hasChildren is false for an empty children array
     */
    public function testHasChildrenIsFalseForEmptyArray(): void
    {
        $nav   = $this->createNav(['includeToggle' => true]);
        $items = $nav->normalizeItems([['children' => []]]);

        $this->assertFalse($items[0]['hasChildren']);
    }

    /**
     * @testdox hasChildren is true when children is boolean true (async intent)
     */
    public function testHasChildrenIsTrueForBooleanTrue(): void
    {
        $nav   = $this->createNav(['includeToggle' => true]);
        $items = $nav->normalizeItems([['children' => true]]);

        $this->assertTrue($items[0]['hasChildren']);
    }

    // -------------------------------------------------------------------------
    // normalizeItems – hasToggle
    // -------------------------------------------------------------------------

    /**
     * @testdox hasToggle is false for leaf items (children === false)
     */
    public function testHasToggleIsFalseForLeafItem(): void
    {
        $nav   = $this->createNav(['includeToggle' => true]);
        $items = $nav->normalizeItems([['children' => false]]);

        $this->assertFalse($items[0]['hasToggle']);
    }

    /**
     * @testdox hasToggle is true for items with a non-empty children array
     */
    public function testHasToggleIsTrueForNonEmptyChildrenArray(): void
    {
        $nav   = $this->createNav(['includeToggle' => true]);
        $items = $nav->normalizeItems([
            ['children' => [['label' => 'Child One']]],
        ]);

        $this->assertTrue($items[0]['hasToggle']);
    }

    /**
     * @testdox hasToggle is false for items with an empty children array
     */
    public function testHasToggleIsFalseForEmptyChildrenArray(): void
    {
        $nav   = $this->createNav(['includeToggle' => true]);
        $items = $nav->normalizeItems([['children' => []]]);

        $this->assertFalse($items[0]['hasToggle']);
    }

    /**
     * @testdox hasToggle is false when children is true but no async metadata
     */
    public function testHasToggleIsFalseForBooleanTrueWithoutAsyncMetadata(): void
    {
        $nav   = $this->createNav(['includeToggle' => true]);
        $items = $nav->normalizeItems([['children' => true]]);

        $this->assertFalse($items[0]['hasToggle']);
    }

    /**
     * @testdox hasToggle is true when children is true and data-fetch-url is present
     */
    public function testHasToggleIsTrueForBooleanTrueWithAsyncMetadata(): void
    {
        $nav   = $this->createNav(['includeToggle' => true]);
        $items = $nav->normalizeItems([
            [
                'children'      => true,
                'attributeList' => ['data-fetch-url' => 'https://example.com/children'],
            ],
        ]);

        $this->assertTrue($items[0]['hasToggle']);
    }

    /**
     * @testdox hasToggle is false when children is true and data-fetch-url is empty
     */
    public function testHasToggleIsFalseForBooleanTrueWithEmptyFetchUrl(): void
    {
        $nav   = $this->createNav(['includeToggle' => true]);
        $items = $nav->normalizeItems([
            [
                'children'      => true,
                'attributeList' => ['data-fetch-url' => ''],
            ],
        ]);

        $this->assertFalse($items[0]['hasToggle']);
    }

    /**
     * @testdox hasToggle is false when includeToggle is disabled, even with children
     */
    public function testHasToggleIsFalseWhenIncludeToggleIsDisabled(): void
    {
        $nav   = $this->createNav(['includeToggle' => false]);
        $items = $nav->normalizeItems([
            [
                'children'      => true,
                'attributeList' => ['data-fetch-url' => 'https://example.com/children'],
            ],
        ]);

        $this->assertFalse($items[0]['hasToggle']);
    }

    /**
     * @testdox hasToggle is false when includeToggle is disabled for concrete children
     */
    public function testHasToggleIsFalseWhenIncludeToggleIsDisabledForConcreteChildren(): void
    {
        $nav   = $this->createNav(['includeToggle' => false]);
        $items = $nav->normalizeItems([
            ['children' => [['label' => 'Child One']]],
        ]);

        $this->assertFalse($items[0]['hasToggle']);
    }

    // -------------------------------------------------------------------------
    // Integration – item class list reflects toggle state
    // -------------------------------------------------------------------------

    /**
     * @testdox item class list does not include has-toggle for leaf items
     */
    public function testItemClassListDoesNotContainHasToggleForLeafItem(): void
    {
        $nav  = $this->createNav([
            'includeToggle' => true,
            'items'         => [['label' => 'Leaf', 'children' => false]],
        ]);
        $data = $nav->getData();

        $itemClass = $data['itemClass']($data['items'][0], 'vertical');

        $this->assertStringNotContainsString('has-toggle', $itemClass);
    }

    /**
     * @testdox item class list includes has-toggle for items with concrete children
     */
    public function testItemClassListContainsHasToggleForConcreteChildren(): void
    {
        $nav  = $this->createNav([
            'includeToggle' => true,
            'items'         => [
                [
                    'label'    => 'Parent',
                    'children' => [['label' => 'Child One']],
                ],
            ],
        ]);
        $data = $nav->getData();

        $itemClass = $data['itemClass']($data['items'][0], 'vertical');

        $this->assertStringContainsString('has-toggle', $itemClass);
    }

    /**
     * @testdox item class list does not include has-toggle when children is true without async URL
     */
    public function testItemClassListDoesNotContainHasToggleForBooleanTrueWithoutAsyncUrl(): void
    {
        $nav  = $this->createNav([
            'includeToggle' => true,
            'items'         => [['label' => 'Async Item', 'children' => true]],
        ]);
        $data = $nav->getData();

        $itemClass = $data['itemClass']($data['items'][0], 'vertical');

        $this->assertStringNotContainsString('has-toggle', $itemClass);
    }

    /**
     * @testdox item class list includes has-toggle when children is true with a valid async URL
     */
    public function testItemClassListContainsHasToggleForBooleanTrueWithAsyncUrl(): void
    {
        $nav  = $this->createNav([
            'includeToggle' => true,
            'items'         => [
                [
                    'label'         => 'Async Item',
                    'children'      => true,
                    'attributeList' => ['data-fetch-url' => 'https://example.com/children'],
                ],
            ],
        ]);
        $data = $nav->getData();

        $itemClass = $data['itemClass']($data['items'][0], 'vertical');

        $this->assertStringContainsString('has-toggle', $itemClass);
    }

    // -------------------------------------------------------------------------
    // Backward-compatibility – active/ancestor open-state behaviour
    // -------------------------------------------------------------------------

    /**
     * @testdox active ancestor item with concrete children gets is-open class in vertical nav
     */
    public function testActiveAncestorWithConcreteChildrenGetsIsOpenClass(): void
    {
        $nav  = $this->createNav([
            'includeToggle' => true,
            'items'         => [
                [
                    'label'    => 'Parent',
                    'active'   => true,
                    'children' => [['label' => 'Child One']],
                ],
            ],
        ]);
        $data = $nav->getData();

        $itemClass = $data['itemClass']($data['items'][0], 'vertical');

        $this->assertStringContainsString('is-open', $itemClass);
    }

    /**
     * @testdox ancestor item without active state gets is-open class in vertical nav
     */
    public function testAncestorItemGetsIsOpenClass(): void
    {
        $nav  = $this->createNav([
            'includeToggle' => true,
            'items'         => [
                [
                    'label'    => 'Ancestor',
                    'ancestor' => true,
                    'children' => [['label' => 'Child One']],
                ],
            ],
        ]);
        $data = $nav->getData();

        $itemClass = $data['itemClass']($data['items'][0], 'vertical');

        $this->assertStringContainsString('is-open', $itemClass);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Creates a Nav instance with the given data merged over sensible defaults.
     *
     * @param array $data Data to merge over defaults.
     *
     * @return Nav
     */
    private function createNav(array $data = []): Nav
    {
        $defaults = [
            'items'              => [],
            'direction'          => 'vertical',
            'includeToggle'      => false,
            'isExtendedDropdown' => false,
            'allowStyle'         => true,
            'buttonStyle'        => 'filled',
            'buttonColor'        => 'primary',
            'expandLabel'        => 'Expand',
            'height'             => '',
            'compressed'         => false,
            'expandIcon'         => 'expand_more',
            'indentSubLevels'    => false,
        ];

        return new Nav(
            array_merge($defaults, $data),
            $this->createStub(CacheInterface::class),
            $this->createTagSanitizerStub(),
        );
    }

    /**
     * Creates a stub for TagSanitizerInterface.
     *
     * @return TagSanitizerInterface
     */
    private function createTagSanitizerStub(): TagSanitizerInterface
    {
        return new class implements TagSanitizerInterface {
            public function removeATags(string $string): string
            {
                return $string;
            }
        };
    }
}
