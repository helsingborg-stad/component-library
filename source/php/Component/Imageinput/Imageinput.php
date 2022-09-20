<?php

namespace ComponentLibrary\Component\Imageinput;

class Imageinput extends \ComponentLibrary\Component\BaseController
{

    const DEFAULT_ASPECT_RATIO = '16:9';

    const ALLOWED_ASPECT_RATIOS = [
        '16:9',
        '4:3',
        '1:1'
    ];

    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);

        if(empty($this->data['id']) ) {
            $this->data['id'] = uniqid();
        }

        if ($display === 'area') {
            $this->data['classList'][] = 'c-imageinput--area';
        }

        if($filesMax) {
            $this->data['attributeList']['filesMax'] = $filesMax;
        }
        
        // Aspect ratio for preview image
        $this->data['aspectRatio'] = in_array($aspectRatio, self::ALLOWED_ASPECT_RATIOS) ? $aspectRatio : self::DEFAULT_ASPECT_RATIO;
        $this->data['aspectRatioClass'] = 'u-ratio-' . str_replace(':', '-', $this->data['aspectRatio']);
    }
}
