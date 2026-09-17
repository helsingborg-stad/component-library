<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Notification;

use Illuminate\Support\HtmlString;

final class NotificationData
{
    public function __construct(
        public string $element = 'div',
        public ?HtmlString $slot = null,
        public array $message = [],
        public ?string $type = null,
        public array $icon = [],
        public array $animation = ['onPageLoad' => false, 'direction' => null],
    ) {}
}
