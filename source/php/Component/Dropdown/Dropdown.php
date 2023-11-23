<?php

namespace ComponentLibrary\Component\Dropdown;

/**
 * Class Dropdown
 * @package ComponentLibrary\Component\Dropdown
 */
class Dropdown extends \ComponentLibrary\Component\BaseController
{

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['listSlotHasContent'] = $this->slotHasData('list');

        $this->data['items'] = array_map(
            fn ($i) => array_merge(
                $i,
                [
                    'attributes' => self::buildAttributes(
                        array_merge(
                            $i['attributeList'] ?? [],
                            [
                                'class' => implode(' ', [
                                    'c-dropdown__item',
                                    ...$i['classList'] ?? []
                                ])
                            ]
                        )
                    ),
                    'linkAttributes' => self::buildAttributes($i['linkAttributeList'] ?? []),
                ]
            ),
            $this->data['items'] ?? []
        );
        
        $this->data['classList'][] = 'js-dropdown';
        
        if (isset($direction)) {
            $this->data['direction'] = $direction;
            $this->data['classList'][] = $this->getBaseClass() . '-button--' . $direction;
        }

        if (isset($direction) && $popup === 'focus') {
            $this->data['classList'][] = $this->getBaseClass() . '-button--' . $direction . '__focus';
        }

        if (isset($direction) && $popup === 'click') {
            $this->data['classList'][] = $this->getBaseClass() . '-button--' . $direction . '__click';
        }

        if (isset($popup)) {
            $this->data['classList'][] = $this->getBaseClass() . '--on-' . $popup;
        }
    }
}
