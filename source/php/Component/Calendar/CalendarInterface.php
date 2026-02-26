<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Calendar;

use ComponentLibrary\Component\ComponentInterface;

interface CalendarInterface extends ComponentInterface
{
    /**
     * ComponentElement.
     */
    public function getComponentElement(): string;

    /**
     * Size.
     */
    public function getSize(): string;

    /**
     * Get.
     */
    public function getGet(): string;

    /**
     * Set.
     */
    public function getSet(): string;

    /**
     * Color.
     */
    public function getColor(): string;

    /**
     * WeekStart.
     */
    public function getWeekStart(): string;

}
