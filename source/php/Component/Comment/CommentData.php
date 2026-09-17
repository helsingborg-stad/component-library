<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Comment;

final class CommentData
{
    public function __construct(
        public string $author = '',
        public string $author_url = '',
        public string $author_image = '',
        public string $text = '',
        public string $icon = '',
        public string $bubble_color = 'dark',
        public string $date = '01/02/2019',
        public string $date_suffix = 'ago',
        public array $dateLabels = [],
        public array $dateLabelsPlural = [],
        public string $componentElement = 'div',
        public bool $is_reply = false,
        public bool $filterHtml = false,
        public string $allowedTags = '<b><strong><i><em><mark><small><del><ins><sub><sup>',
        public object|bool $actions = false,
    ) {}
}
