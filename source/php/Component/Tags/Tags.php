<?php

namespace ComponentLibrary\Component\Tags;

class Tags extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['tags'] = $this->arrayCleanUp($tags);

        if ($format) {
            $this->data['classList'][] = $this->getBaseClass() . "--format";
        }
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
                //var_dump($arr);
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
                //var_dump($filteredTags);
            }
        }

        return $filteredTags;
    }
}
