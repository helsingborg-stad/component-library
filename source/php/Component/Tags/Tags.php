<?php

namespace ComponentLibrary\Component\Tags;

class Tags extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['tags'] = $this->arrayCleanUp($tags);

        $this->data['tagCount'] = count($tags); 

        if ($format) {
            $this->data['classList'][] = $this->getBaseClass() . "--format";
        }

        $this->data['isHidden'] = function ($loopIteration) use($compress) {
            if($compress !== false) {
                if($loopIteration >= $compress) {
                    return "is-hidden"; 
                }
            }
            return ""; 
        };
    }

    /**
     * Ensures that the array has data to prevent errors
     *
     * @param Array $arr Array with tags
     * @return Array $filteredTags An array that's been checked to not have empty fields
     */
    private function arrayCleanUp($arr)
    {
        $filteredTags = [];

        if (!empty($arr)) {
            foreach ($arr as $tag) {
                if (!array_key_exists('href', $tag)) {
                    $tag['href'] = "";
                }
                if (!array_key_exists('label', $tag)) {
                    $tag['label'] = "No label";
                }
                if (!array_key_exists('color', $tag)) {
                    $tag['color'] = "default";
                }

                $filteredTags[] = $tag;
            }
        }

        return $filteredTags;
    }
}
