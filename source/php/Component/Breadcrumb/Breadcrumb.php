<?php

namespace ComponentLibrary\Component\Breadcrumb;

/**
 * Class Breadcrumb
 * @package ComponentLibrary\Component\Breadcrumb
 */
class Breadcrumb extends \ComponentLibrary\Component\BaseController implements BreadcrumbInterface  
{
    
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

		// Customizer settings
		if(function_exists('apply_filters')) {
			$this->data['customizer'] = apply_filters('Municipio/Controller/Customizer', []);
		} else {
			$this->data['customizer'] = new \stdClass();
		}

		if (is_null($truncate)) {
			$this->data['truncate'] = $this->data['defaultTruncate'] ?? 30;
		}

		$prefixClass = [];
		if (!($this->data['customizer']->breadcrumbShowPrefixLabel ?? false)) {	
			$prefixClass[] = 'u-sr__only';
		}
		$this->data['prefixClass'] = implode(' ', $prefixClass);

		$this->data['showHomeIcon'] = $this->data['customizer']->breadcrumbShowHomeIcon ?? true;
		
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
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'breadcrumb';
    }

    // -------------------------------------------------------------------------
    // BreadcrumbInterface — generated getters
    // -------------------------------------------------------------------------

    public function getList(): array
    {
        return $this->data['list'] ?? [];
    }

    public function getLabel(): string
    {
        return $this->data['label'] ?? 'Breadcrumb';
    }

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'nav';
    }

    public function getListType(): string
    {
        return $this->data['listType'] ?? 'ol';
    }

    public function getListItemType(): string
    {
        return $this->data['listItemType'] ?? 'li';
    }

    public function getPrefixLabel(): string
    {
        return $this->data['prefixLabel'] ?? '';
    }

    public function getTruncate(): int|bool
    {
        return $this->data['truncate'] ?? null;
    }
}
