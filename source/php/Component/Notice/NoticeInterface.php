<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Notice;

use ComponentLibrary\Component\ComponentInterface;

interface NoticeInterface extends ComponentInterface
{
    /**
     * Type of notice: success, warning, danger, info.
     */
    public function getType(): string;

    /**
     * An array with two parameters: title and text.
     */
    public function getMessage(): array|object;

    /**
     * The icon according to the @icon component.
     */
    public function getIcon(): array;

    /**
     * If true, the notice will stretch to the full width of the viewport.
     */
    public function getStretch(): bool;

    /**
     * If not false, the notice will have a close button. Allowed trueish values: immediate (show notice on reload), session (show notice at next visit, default), permanent (show notice when local storage is wiped).
     */
    public function getDismissable(): bool|string;

    /**
     * An array with three parameters: label (text), url and position (aside|below).
     */
    public function getAction(): array|bool;

}
