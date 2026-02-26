<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Date;

use ComponentLibrary\Component\ComponentInterface;

interface DateInterface extends ComponentInterface
{
    /**
     * The date, in date string format or in unix timestamp format.
     */
    public function getTimestamp(): string|int;

    /**
     * Will return the date since.
     */
    public function getTimeSince(): bool;

    /**
     * How long back to spell out time since.
     */
    public function getTimeSinceCap(): string;

    /**
     * Present date's in this format. Default: D d M Y.
     */
    public function getFormat(): string;

    /**
     * Region for the date.
     */
    public function getRegion(): string;

    /**
     * Timezone for the date.
     */
    public function getTimezone(): string;

    /**
     * What to do with the inputted date: formatDate, timesince, timeuntil. Can be false to just output the timestamp.
     */
    public function getAction(): string|bool;

    /**
     * Array containing translations valid keys: year, month, week, day, hour, minute, second.
     */
    public function getLabels(): object|array;

    /**
     * Array containing translations valid keys: year, month, week, day, hour, minute, second.
     */
    public function getLabelsPlural(): object|array;

    /**
     * Suffix for the time since label.
     */
    public function getTimeSinceSuffix(): string;

    /**
     * What to show when the date is considered to be in the present.
     */
    public function getNowLabel(): string;

    /**
     * How many seconds back to show 'nowLabel'.
     */
    public function getTimeNowCap(): int;

}
