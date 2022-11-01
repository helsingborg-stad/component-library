<?php

namespace ComponentLibrary\Component\Testimonials;

/**
 * Class Testimonials
 * @package ComponentLibrary\Component\Testimonials
 */
class Testimonials extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Overwrite baseclass
        $this->data['baseClass'] = 'c-testimonial';
        $this->data['wrapperClassList'] = [];
        $this->data['wrapperAttributeList'] = [];
        if(isset($ariaLabels)) {
            $this->data['ariaLabels'] = $ariaLabels;
        }

        if($isCarousel) {
            $this->data['wrapperClassList'][] = 'c-testimonials__wrapper--is-carousel';

            $this->data['wrapperAttributeList']['js-testimonials--is-carousel'] = true;
            $this->data['classList'][] = $this->getBaseClass() . '--is-hidden'; 
        } 

        $this->compParams = [
            'testimonials' => $testimonials,
            'perRow' => $perRow,
            'componentElement' => $componentElement
        ];

        $this->data['wrapperClassList'] = implode(' ', $this->data['wrapperClassList'] );
        $this->data['wrapperAttributeList'] = self::buildAttributes($this->data['wrapperAttributeList']);
        

        $this->mapData();
    }

    /**
     * Mapping data
     */
    public function mapData()
    {
        $this->data['testimonials'] = !empty($this->compParams['testimonials']) &&
        is_array($this->compParams['testimonials']) ? $this->compParams['testimonials'] : array();

        // Sanitize testimonials data
        $this->data['testimonials'] = array_map(
            function ($testimonial) {
                return array(
                    'name' => $testimonial['name'] ?? '',
                    'title' => $testimonial['title'] ?? '',
                    'testimonial' => $testimonial['testimonial'] ?? '',
                    'titleElement' => 'h4',
                    'nameElement' =>  'h2',
                    'image' => $testimonial['image'] ?? '',
                    'avatar' => $testimonial['avatar'] ?? true,
                    'quoteColor' => $testimonial['quoteColor'] ?? 'grey',
                    'imageTop' => $testimonial['imageTop'] ?? false
                );
            },
            $this->compParams['testimonials']
        ); 

        $grid = $this->calculateGrid();
        
        $this->data['gridClasses'] = 'grid-xs-12 grid-sm-6 grid-lg-' . $grid;
    }

    /**
     * Calculate grid rows
     */
    public function calculateGrid()
    {
        $perRow = ((int)$this->compParams['perRow'] > 0 && (int)$this->compParams['perRow'] <= 12) ?
            (int)$this->compParams['perRow'] : 1;
        return is_int(12 / $perRow) ? 12 / $perRow : 12;
    }

}
