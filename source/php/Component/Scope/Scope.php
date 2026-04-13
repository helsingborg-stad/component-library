<?php

namespace ComponentLibrary\Component\Scope;

class Scope extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        if (!empty($this->data['name'])) {
            if (is_array($this->data['name'])) {
                $scopes = array_filter($this->data['name']);
    
                $scopes = array_map(
                    fn($scope) => 's-' . $scope . ';',
                    $scopes
                );
    
                $this->data['attributeList']['data-scope'] = implode(' ', $scopes);
            } else {
                $this->data['attributeList']['data-scope'] = 's-' . $this->data['name'] . ';';
            }
        }
    }
}
