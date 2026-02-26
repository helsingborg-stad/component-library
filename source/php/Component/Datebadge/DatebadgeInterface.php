<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Datebadge;

use ComponentLibrary\Component\ComponentInterface;

interface DatebadgeInterface extends ComponentInterface
{
    /**
     * A date string in any format or a unix timestamp.
     */
    public function getDate(): string|int;

    /**
     * The size of the datebadge. Can be either 'sm', 'md' or 'lg'.
     */
    public function getSize(): string;

    /**
     * If true, the datebadge will have a translucent background.
     */
    public function getTranslucent(): bool;

    /**
     * The color of the datebadge. Can be either 'light', 'dark', 'primary', 'secondary'.
     */
    public function getColor(): string;

}
