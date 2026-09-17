<?php

declare(strict_types=1);

use ComponentLibrary\Component\Notification\NotificationData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'notification',
    view: 'notification.blade.php',
    data: NotificationData::class,
    dependencies: ['sass' => ['components' => ['notification', 'notice', 'button', 'icon']]],
);
