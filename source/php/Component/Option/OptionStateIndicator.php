<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Option;

/**
 * Normalizes the `stateIndicator` input of the Option component into view data.
 */
final class OptionStateIndicator
{
    public const STATE_NEUTRAL = 'neutral';
    public const STATES = [self::STATE_NEUTRAL, 'success', 'warning', 'danger'];

    /**
     * @param mixed $input The raw input, e.g. ['text' => 'Permit required', 'state' => 'danger'].
     * @param string $id The sanitized option id, used to build the element id.
     * @return array{text: string, state: string, id: string, class: string}|null Null when there is no text.
     */
    public static function normalize(mixed $input, string $id): ?array
    {
        if (!is_array($input)) {
            return null;
        }

        $text = trim((string) ($input['text'] ?? ''));

        if ($text === '') {
            return null;
        }

        $state = (string) ($input['state'] ?? self::STATE_NEUTRAL);
        $state = in_array($state, self::STATES, true) ? $state : self::STATE_NEUTRAL;

        return [
            'text' => $text,
            'state' => $state,
            'id' => 'state_' . $id,
            'class' => $state === self::STATE_NEUTRAL
                ? 'c-option__aside'
                : 'c-option__aside c-option__aside--' . $state,
        ];
    }
}
