<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Comment;

use ComponentLibrary\Component\ComponentInterface;

interface CommentInterface extends ComponentInterface
{
    /**
     * Name of the commenter.
     */
    public function getAuthor(): string;

    /**
     * URL to the profile of the author.
     */
    public function getAuthorUrl(): string;

    /**
     * A link to an image.
     */
    public function getAuthorImage(): string;

    /**
     * Content of the comment.
     */
    public function getText(): string;

    /**
     * Which icon to show.
     */
    public function getIcon(): string;

    /**
     * Color for comment bubble background: light or dark.
     */
    public function getBubbleColor(): string;

    /**
     * The date when the comment was posted.
     */
    public function getDate(): string;

    /**
     * Time elapsed 'since' .
     */
    public function getDateSuffix(): string;

    /**
     * Array containing translations valid keys: year, month, week, day, hour, minute, second.
     */
    public function getDateLabels(): array;

    /**
     * Array containing translations valid keys: year, month, week, day, hour, minute, second.
     */
    public function getDateLabelsPlural(): array;

    /**
     * Element of the component.
     */
    public function getComponentElement(): string;

    /**
     * If true the comment will be displayed as a reply.
     */
    public function getIsReply(): bool;

    /**
     * If set to true the comment will be filtered from html tags.
     */
    public function getFilterHtml(): bool;

    /**
     * Which tags should be excluded from filtration.
     */
    public function getAllowedTags(): string;

}
