<?php

namespace ComponentLibrary\Component\Tags;

class Tags extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['tags'] = $this->arrayCleanUp($tags);

        $this->data['tagCount'] = is_countable($tags) ? count($tags) : 0;

        if ($format) {
            $this->data['classList'][] = $this->getBaseClass() . "--format";
        }


        if (!empty($this->data['tagsMarker'])) {
            /* TODO: add functionality to get and set the icon color based on taxonomy color */
            $this->data['icon'] = ['icon' => 'circle', 'size' => 'xs'];

            if (!empty($this->data['icon'])) {
                $this->data['beforeLabel'] = "";
            }
        }

        if (!empty($this->data['tagsStyle'])) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $this->data['tagsStyle'];
        }

        $this->data['isHidden'] = function ($loopIteration) use ($compress) {
            if ($compress !== false) {
                if ($loopIteration >= $compress) {
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

        if (!empty($arr) && is_countable($arr)) {
            foreach ($arr as $tag) {
                if (!is_array($tag)) {
                    $tag = [];
                }

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
