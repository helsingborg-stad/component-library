<?php

namespace ComponentLibrary\Component\Comment;

class Comment extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['slotHasData']         = $this->slotHasData('slot');

        //Define actions (slot)
        $this->data['actions'] = isset($actions) ? $actions : false;

        //Is reply
        if ($is_reply) {
            $this->data['classList'][] = $this->getBaseClass() . '__is-reply';
        }

        //Filter html
        if ($filterHtml) {
            $this->data['text'] = $this->filterTags(
                $text,
                $allowedTags
            );
        }
    }

    /**
     * Filter tags
     */
    public function filterTags($text, $allowedTextTags)
    {
        $allowedTextTags = '<b><strong><i><em><mark><small><del><ins><sub><sup>';
        if ($text !== strip_tags($text, $allowedTextTags)) {
            return strip_tags($text, $allowedTextTags);
        }
        return $text;
    }
}
