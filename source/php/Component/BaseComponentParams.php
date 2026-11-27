<?php

declare(strict_types=1);

namespace ComponentLibrary\Component;

/**
 * Params that every component accepts through BaseController, so they are never reported as unrecognized.
 */
final class BaseComponentParams
{
    public const NAMES = [
        '__laravel_slots',
        'slot',
        'id',
        'classList',
        'context',
        'attributeList',
        'baseClass',
        'containerAware',
        'lang',
        'isBlock',
        'isShortcode',
    ];
}
