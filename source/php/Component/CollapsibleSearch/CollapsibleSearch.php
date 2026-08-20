<?php

namespace ComponentLibrary\Component\CollapsibleSearch;

/**
 * CollapsibleSearch component controller.
 *
 * Renders a toggle-able search UI: a plain button in its closed state that
 * expands into a pill-shaped search form. All standard button parameters are
 * accepted and passed through to the trigger button unchanged.
 */
class CollapsibleSearch extends \ComponentLibrary\Component\BaseController
{
    /**
     * Initialize component data.
     *
     * @return void
     */
    public function init(): void
    {
        // Force the BEM base class to the hyphenated form.
        $this->data['baseClass'] = 'c-collapsible-search';

        // Generate a stable unique ID usable for aria-controls / label pairing.
        $this->data['uid'] = $this->getUid();

        extract($this->data);

        // Expanded modifier
        if ($isExpanded) {
            $this->data['classList'][] = 'c-collapsible-search--expanded';
        }

        // Normalise lang: Register's shallow (array) cast leaves nested {}
        // objects as stdClass, but the blade accesses $lang as an array.
        $this->data['lang'] = (array) ($lang ?? []);

        // Normalise button: ensure it is always a plain PHP array regardless
        // of whether the JSON default or a caller supplied a stdClass object.
        $button = (array) ($button ?? []);
        $this->data['button'] = $button;

        // Expose the button's size to the blade template so internal buttons
        // (submit, close) can match the trigger size.
        $this->data['size'] = $button['size'] ?? 'md';

        // Normalise icon: the public API accepts both a plain string and the
        // array form ['name' => '...', 'size' => '...', ...] used elsewhere in
        // the styleguide.  Icon.php only accepts a string, so extract the name.
        if (is_array($button['icon'] ?? null)) {
            $button['icon'] = $button['icon']['name'] ?? $button['icon']['icon'] ?? false;
        }

        // Merge required accessibility & behaviour attributes into the button
        // array without overwriting any caller-supplied values.
        $this->data['button'] = array_merge(
            (array) $button,
            [
                'componentElement' => 'button',
                'type' => 'button',
                'attributeList' => array_merge(
                    (array) ($button['attributeList'] ?? []),
                    [
                        'aria-expanded' => $isExpanded ? 'true' : 'false',
                        'aria-controls' => $uid . '-panel',
                        'data-js-collapsible-search-trigger' => '',
                    ],
                ),
            ],
        );

        // Merge the component data-attribute onto the wrapper element.
        $this->data['attributeList'] = array_merge(
            (array) ($attributeList ?? []),
            ['data-js-collapsible-search' => ''],
        );
    }
}
