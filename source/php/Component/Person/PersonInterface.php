<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Person;

use ComponentLibrary\Component\ComponentInterface;

interface PersonInterface extends ComponentInterface
{
    /**
     * Given name. In the U.S., the first name of a person.
     */
    public function getGivenName(): string;

    /**
     * Family name. In the U.S., the last name of a person.
     */
    public function getFamilyName(): bool;

    /**
     * The job title of the person (for example, Financial Manager).
     */
    public function getJobTitle(): bool;

    /**
     * Email address.
     */
    public function getEmail(): string;

    /**
     * Phone numbers and icon. Array with arrays containing [number: string, icon: smartphone].
     */
    public function getTelephone(): array;

    /**
     * Physical address of the person.
     */
    public function getAddress(): string;

    /**
     * Visiting address of the person (if different from the physical address).
     */
    public function getVisitingAddress(): string;

    /**
     * A brief description of the person.
     */
    public function getDescription(): string;

    /**
     * An image of the person, URL or image ID.
     */
    public function getImage(): int|string;

    /**
     * The administration unit the person belongs to.
     */
    public function getAdministrationUnit(): string;

    /**
     * Social media links for the person.
     */
    public function getSocialMedia(): array;

    /**
     * Custom sections for additional information about the person.
     */
    public function getCustomSections(): array;

    /**
     * Use an avatar image if no image is provided.
     */
    public function getUseAvatarFallback(): bool;

    /**
     * The view file to render the person component, simple or extended.
     */
    public function getView(): string;

}
