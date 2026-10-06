<?php

namespace ComponentLibrary\Component\Person;

class Person extends \ComponentLibrary\Component\BaseController
{
    private $availableViews = ['simple', 'extended'];

    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        $this->prepareData();

        $this->data['view'] = in_array($view, $this->availableViews) ? $view : 'extended';
    }

    private function prepareData()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        // Name
        $this->data['fullName'] = empty($familyName) ? $givenName : $givenName . ' ' . $familyName;

        // Title
        $this->data['fullTitle'] = [];

        if (!empty($jobTitle)) {
            $this->data['fullTitle'][] = $jobTitle;
        }

        if (!empty($administrationUnit)) {
            $this->data['fullTitle'][] = $administrationUnit;
        }

        $this->data['fullTitle'] = implode(', ', $this->data['fullTitle']);

        // Email
        $this->data['email'] = !empty($email) ? $email : false;
    }
}
