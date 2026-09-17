<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Person;

/**
 * Typed input contract for the Person component.
 */
final class PersonData
{
    public function __construct(
        public string $givenName = '',
        public string|bool $familyName = false,
        public string|bool $jobTitle = false,
        public string|bool $email = false,
        public array $telephone = [],
        public string|bool $address = false,
        public string|bool $visitingAddress = false,
        public string|bool $description = false,
        public int|string|bool $image = false,
        public string|bool $administrationUnit = false,
        public array $socialMedia = [],
        public array $customSections = [],
        public bool $useAvatarFallback = true,
        public string $view = 'extended',
    ) {
    }
}