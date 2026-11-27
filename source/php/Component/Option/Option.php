<?php

namespace ComponentLibrary\Component\Option;

/**
 * Class Option
 * @package ComponentLibrary\Component\Option
 */
class Option extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $id = $this->data['id'] = $this->sanitizeIdAttribute(!empty($this->data['id']) ? $this->data['id'] : uniqid());

        if (!empty($name)) {
            $this->data['attributeList']['name'] = $name;
        } else if (!empty($this->data['attributeList']['name'])) {
        } else {
            $this->data['attributeList']['name'] = $label;
        }

        if (!empty($required)) {
            $this->data['attributeList']['required'] = true;
        }

        if (empty($value) && !empty($this->data['attributeList']['value'])) {
            $this->data['value'] = $this->data['attributeList']['value'];
        }

        $this->setAppearance();
        $this->setLabelExtras($id);
    }

    /**
     * Adds the modifier class for the card appearance.
     */
    private function setAppearance(): void
    {
        if (($this->data['appearance'] ?? null) === 'card') {
            $this->data['classList'][] = 'c-option--card';
        }
    }

    /**
     * Prepares description and state indicator view data and links them to the input
     * with aria-describedby. The accessible name is then limited to the label itself.
     *
     * @param string $id The sanitized option id.
     */
    private function setLabelExtras(string $id): void
    {
        $description = trim((string) ($this->data['description'] ?? ''));
        $descriptionId = $description !== '' ? 'description_' . $id : null;
        $stateIndicator = OptionStateIndicator::normalize($this->data['stateIndicator'] ?? null, $id);
        $extraIds = array_values(array_filter([$descriptionId, $stateIndicator['id'] ?? null]));
        $describedBy = array_map('strval', array_filter([
            $this->data['attributeList']['aria-describedby'] ?? null,
            ...$extraIds,
        ]));

        $this->data['description'] = $description;
        $this->data['descriptionId'] = $descriptionId;
        $this->data['stateIndicator'] = $stateIndicator;
        $this->data['hasLabelExtras'] = $extraIds !== [];
        $this->data['labelTextId'] = 'label_' . $id . ($extraIds !== [] ? '_text' : '');

        if ($describedBy !== []) {
            $this->data['attributeList']['aria-describedby'] = implode(' ', $describedBy);
        }
    }
}
