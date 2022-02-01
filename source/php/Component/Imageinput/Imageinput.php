<?php

namespace ComponentLibrary\Component\Imageinput;

class Imageinput extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);

        if ($display === 'area') {
            $this->data['classList'][] = 'c-imageinput--area';
        }

        if($filesMax) {
            $this->data['attributeList']['filesMax'] = $filesMax;
        }
        
        // Aspect ratio for preview image
        $defaultAspectRatio = '16:9';
        $allowedAspectRatios = ['16:9', '4:3', '1:1'];
        $this->data['aspectRatio'] = in_array($aspectRatio, $allowedAspectRatios) ? $aspectRatio : $defaultAspectRatio;
        $this->data['aspectRatioClass'] = 'u-ratio-' . str_replace(':', '-', $this->data['aspectRatio']);
    }
}
