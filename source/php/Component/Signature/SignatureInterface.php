<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Signature;

use ComponentLibrary\Component\ComponentInterface;

interface SignatureInterface extends ComponentInterface
{
    /**
     * The name of the  author.
     */
    public function getAuthor(): string;

    /**
     * Byline of the aythors name. Usally what role the user has related to the page.
     */
    public function getAuthorRole(): string;

    /**
     * Link to an image.
     */
    public function getAvatar(): string;

    /**
     * Size of the avatar.
     */
    public function getAvatarSize(): string;

    /**
     * A formatted published date.
     */
    public function getPublished(): string;

    /**
     * A formatted update date.
     */
    public function getUpdated(): string;

    /**
     * Links the whole component to another place.
     */
    public function getLink(): string;

    /**
     * Label text updated.
     */
    public function getUpdatedLabel(): string;

    /**
     * Label text published.
     */
    public function getPublishedLabel(): string;

    /**
     * If there should be a placeholder avatar.
     */
    public function getPlaceholderAvatar(): bool;

}
