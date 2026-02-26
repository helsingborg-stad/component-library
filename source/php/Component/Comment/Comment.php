<?php

namespace ComponentLibrary\Component\Comment;

class Comment extends \ComponentLibrary\Component\BaseController implements CommentInterface
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
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'comment';
    }

    // -------------------------------------------------------------------------
    // CommentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getAuthor(): string
    {
        return $this->data['author'] ?? '';
    }

    public function getAuthorUrl(): string
    {
        return $this->data['author_url'] ?? '';
    }

    public function getAuthorImage(): string
    {
        return $this->data['author_image'] ?? '';
    }

    public function getText(): string
    {
        return $this->data['text'] ?? '';
    }

    public function getIcon(): string
    {
        return $this->data['icon'] ?? '';
    }

    public function getBubbleColor(): string
    {
        return $this->data['bubble_color'] ?? 'dark';
    }

    public function getDate(): string
    {
        return $this->data['date'] ?? '01/02/2019';
    }

    public function getDateSuffix(): string
    {
        return $this->data['date_suffix'] ?? 'ago';
    }

    public function getDateLabels(): array
    {
        return $this->data['dateLabels'] ?? [];
    }

    public function getDateLabelsPlural(): array
    {
        return $this->data['dateLabelsPlural'] ?? [];
    }

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'div';
    }

    public function getIsReply(): bool
    {
        return $this->data['is_reply'] ?? false;
    }

    public function getFilterHtml(): bool
    {
        return $this->data['filterHtml'] ?? false;
    }

    public function getAllowedTags(): string
    {
        return $this->data['allowedTags'] ?? '<b><strong><i><em><mark><small><del><ins><sub><sup>';
    }
}
