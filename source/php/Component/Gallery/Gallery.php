<?php

namespace ComponentLibrary\Component\Gallery;

class Gallery extends \ComponentLibrary\Component\BaseController implements GalleryInterface
{
	public function init() {
		//Extract array for eazy access (fetch only)
		extract($this->data);

		if(isset($ariaLabels)) {
			$this->data['ariaLabels'] = $ariaLabels;
		}
	}

	public static function getUnique(){
		return uniqid();
	}
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'gallery';
    }

    // -------------------------------------------------------------------------
    // GalleryInterface — generated getters
    // -------------------------------------------------------------------------

    public function getList(): array
    {
        return $this->data['list'] ?? [];
    }

    public function getAriaLabels(): object
    {
        return $this->data['ariaLabels'] ?? [];
    }
}
