<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Notification;

use ComponentLibrary\Component\ComponentInterface;

interface NotificationInterface extends ComponentInterface
{
    /**
     * What element the markup will use.
     */
    public function getElement(): string;

    /**
     * The content.
     */
    public function getSlot(): string;

    /**
     * Message.
     */
    public function getMessage(): array;

    /**
     * Type.
     */
    public function getType(): mixed;

    /**
     * Icon.
     */
    public function getIcon(): array;

    /**
     * Animation.
     */
    public function getAnimation(): object;

}
