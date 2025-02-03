<?php

namespace ComponentLibrary\Component\Breadcrumb;

/**
 * Class Breadcrumb
 * @package ComponentLibrary\Component\Breadcrumb
 */
class Breadcrumb extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);


		if (is_null($truncate)) {
			$this->data['truncate'] = $this->data['defaultTruncate'] ?? 30;
		}
		
		$this->data['list'] = $this->structureBreadcrumbs();
    }

	private function structureBreadcrumbs()
	{
		if (empty($this->data['list'])) {
			return [];
		}

		$list = $this->data['list'];
		foreach ($list as $key => &$item) {
			if (empty($item['icon'])) {
				$item['icon'] = $key ? 'chevron_right' : 'bookmark';
			}

			if (
				$this->data['truncate'] && 
				!empty($item['label']) && 
				strlen($item['label']) > $this->data['truncate']
			) {
				$item['truncatedLabel'] = \ComponentLibrary\Helper\Truncate::truncate($item['label'], $this->data['truncate']);
			}
		}

		return $list;
	}
}