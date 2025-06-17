<?php

namespace ComponentLibrary\Component\Person;

class Person extends \ComponentLibrary\Component\BaseController
{
    private $availableViews = ['simple', 'extended'];

    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        //Translations
        $this->data['lang'] = (object) [
            'email' => __('Email', 'modularity'),
            'call' => __('Call', 'modularity'),
            'address' => __('Address', 'modularity'),
            'visiting_address' => __('Visiting address', 'modularity')
        ];

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
        $this->data['fullTitle'] = empty($administrationUnit) ? $jobTitle : $jobTitle . ', ' . $administrationUnit;

        // Email
        $this->data['email'] = !empty($email) ? $email : false;
    }
}
