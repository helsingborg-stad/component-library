<?php

namespace ComponentLibrary\Component\Person;

class Person extends \ComponentLibrary\Component\BaseController implements PersonInterface
{
    private $availableViews = ['simple', 'extended'];

    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        $this->prepareData();

        $this->data['view'] = in_array($view, $this->availableViews) ? $view : 'extended';
    }

    private function prepareData()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        // Name
        $this->data['fullName'] = empty($familyName) ? $givenName : $givenName . ' ' . $familyName;

        // Title
        $this->data['fullTitle'] = empty($administrationUnit) ? $jobTitle : $jobTitle . ', ' . $administrationUnit;

        // Email
        $this->data['email'] = !empty($email) ? $email : false;
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'person';
    }

    // -------------------------------------------------------------------------
    // PersonInterface — generated getters
    // -------------------------------------------------------------------------

    public function getGivenName(): string
    {
        return $this->data['givenName'] ?? '';
    }

    public function getFamilyName(): bool
    {
        return $this->data['familyName'] ?? false;
    }

    public function getJobTitle(): bool
    {
        return $this->data['jobTitle'] ?? false;
    }

    public function getEmail(): string
    {
        return $this->data['email'] ?? false;
    }

    public function getTelephone(): array
    {
        return $this->data['telephone'] ?? [];
    }

    public function getAddress(): string
    {
        return $this->data['address'] ?? false;
    }

    public function getVisitingAddress(): string
    {
        return $this->data['visitingAddress'] ?? false;
    }

    public function getDescription(): string
    {
        return $this->data['description'] ?? false;
    }

    public function getImage(): int|string
    {
        return $this->data['image'] ?? false;
    }

    public function getAdministrationUnit(): string
    {
        return $this->data['administrationUnit'] ?? false;
    }

    public function getSocialMedia(): array
    {
        return $this->data['socialMedia'] ?? [];
    }

    public function getCustomSections(): array
    {
        return $this->data['customSections'] ?? [];
    }

    public function getUseAvatarFallback(): bool
    {
        return $this->data['useAvatarFallback'] ?? true;
    }

    public function getView(): string
    {
        return $this->data['view'] ?? 'extended';
    }
}
