<?php

namespace ComponentLibrary\Component\Signature;

class Signature extends \ComponentLibrary\Component\BaseController implements SignatureInterface
{

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['classList'][] = $this->getBaseClass() . "--space-" . count(array_filter([$updated, $published])); 

        //Component element
        if($link) {
            $this->data['componentElement'] = "a"; 
            $this->data['attributeList'] = ['href' => $link]; 
		} else {
			$this->data['componentElement'] = "div"; 
        }

        if (empty($avatar) && empty($placeholderAvatar)) {
            $this->data['classList'][] = $this->getBaseClass('no-avatar', true);
        }

        //Labels
        $this->data['label'] = (object) [
            'publish' => $publishedLabel ?: false,
            'updated' => $updatedLabel ?: false
        ]; 

    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'signature';
    }

    // -------------------------------------------------------------------------
    // SignatureInterface — generated getters
    // -------------------------------------------------------------------------

    public function getAuthor(): string
    {
        return $this->data['author'] ?? '';
    }

    public function getAuthorRole(): string
    {
        return $this->data['authorRole'] ?? '';
    }

    public function getAvatar(): string
    {
        return $this->data['avatar'] ?? '';
    }

    public function getAvatarSize(): string
    {
        return $this->data['avatar_size'] ?? 'md';
    }

    public function getPublished(): string
    {
        return $this->data['published'] ?? '';
    }

    public function getUpdated(): string
    {
        return $this->data['updated'] ?? '';
    }

    public function getLink(): string
    {
        return $this->data['link'] ?? '';
    }

    public function getUpdatedLabel(): string
    {
        return $this->data['updatedLabel'] ?? 'Updated';
    }

    public function getPublishedLabel(): string
    {
        return $this->data['publishedLabel'] ?? 'Published';
    }

    public function getPlaceholderAvatar(): bool
    {
        return $this->data['placeholderAvatar'] ?? true;
    }
}
