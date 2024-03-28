<?php

namespace ComponentLibrary\Component\Pagination;

class Pagination extends \ComponentLibrary\Component\BaseController  
{

    //Handles temporary working list of items
    private $tmpList = [];
    
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Default to page one
        if(!$current) {
            $this->data['current'] = 1; 
        }

        /* Javascrip pagination */
        if($this->data['useJS']) {
            $this->data['list'] = [['label' => '', 'href' => '']];
            $this->data['attributeList']['data-js-pagination'] = '';
            $this->data['attributeList']['data-js-pagination-per-page'] = $this->data['perPage'];
            $this->data['attributeList']['data-js-pagination-max-pages'] = $this->data['maxPages'];
            $this->data['attributeList']['data-js-pagination-pages-to-show'] = $this->data['pagesToShow'];
            if ($keepDOM) {
                $this->data['attributeList']['data-js-pagination-keep-dom'] = '';
            }
            if ($randomizeOrder) {
                $this->data['attributeList']['data-js-pagination-randomize-order'] = '';
            }
        }
    
        //Anchor
        if(isset($this->data['list']) && is_array($this->data['list']) && !empty($this->data['list'])) {
            foreach($this->data['list'] as &$item) {
                if(isset($item['href'])) {
                    $item['href'] = $item['href'] . $anchorTag; 
                }
            }
        }

        //Previous data
        if($this->data['current'] != 1) {
            $this->data['previous'] = $this->handlePrefixUrlParam($linkPrefix, ($this->data['current'] - 1)) . $anchorTag; 
        } else {
            $this->data['previous'] = ''; 
            $this->data['previousDisabled'] = 'true'; 
        }

        //Next data
        if((count($this->data['list'])) != $this->data['current']) {
            $this->data['next'] = $this->handlePrefixUrlParam($linkPrefix, ($this->data['current'] + 1)) . $anchorTag; 
        } else {
            $this->data['next'] = ''; 
            $this->data['nextDisabled'] = 'true'; 
        }

        $this->tmpList = $this->data['list'];
        $this->data['list'] = $this->overflow();
        $this->data['firstItem'] = $this->firstItem();
        $this->data['lastItem'] = $this->lastItem();
    }

    /**
     * Handles the generation of a paged URL with the specified prefix and page number.
     *
     * @param string $prefix The prefix for the URL parameter.
     * @param int $pageNumber The page number to be included in the URL.
     * @return string The generated paged URL.
     */
    private function handlePrefixUrlParam($prefix, $pageNumber) {
        if (!isset($_SERVER)) {
            return '';
        }
    
        $urlParams = $_SERVER['QUERY_STRING'];
        parse_str($urlParams, $params);
        
        $params[$prefix] = $pageNumber;
    
        $newUrlParams = http_build_query($params);
    
        $url = '?' . $newUrlParams;
    
        return $url;
    }

    /**
     * Returns a subset of items from the pagination list based on the current item and the allowed number of items.
     *
     * @return array The subset of items from the pagination list.
     */
    public function overflow()
    {
        $allowedItems = 5;
        $itemsLength = count($this->data['list']);

        if($itemsLength <= $allowedItems) {
            return $this->data['list'];
        }

        $currentItem = $this->data['current'];
        $currentIndex = $currentItem -1;
        $offset = 2;
        $firstIndex = $currentIndex - $offset < 0 ? 0 : $currentIndex - $offset;

        if($itemsLength - $currentItem < $offset) {
            $offset = $offset - ($itemsLength - $currentItem );
            $firstIndex = $firstIndex - $offset;
        }

        return array_slice($this->data['list'],  $firstIndex, $allowedItems, true);
    }

    /**
     * Returns the first item in the pagination list.
     *
     * @return mixed The first item in the pagination list, or false if the list is empty.
     */
    public function firstItem()
    {
        if (array_key_exists(0, $this->data['list'])) {
            return false;
        }

        if (array_key_exists(1, $this->data['list'])) {
            array_unshift($this->data['list'], $this->tmpList[0]);

            return false;
        }

        $item = $this->tmpList[0];
        $item['key'] = 0;

        return $item;
    }

    /**
     * Returns the last item in the pagination list.
     *
     * @return mixed The last item in the pagination list, or false if the last item is already present in the data list.
     */
    public function lastItem()
    {
        $lastKey = count($this->tmpList) - 1;
        
        if(array_key_exists($lastKey, $this->data['list'])) {
            return false;
        }

        if(array_key_exists($lastKey -1, $this->data['list'])) {
            $this->data['list'][] = end($this->tmpList);
            return false;
        }

        $item = end($this->tmpList);
        $item['key'] = $lastKey;
        
        return $item;
    }
}