<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Form;

final class FormData
{
    public function __construct(public string $method = 'POST', public string $action = '#', public bool $validation = true, public string $errorMessage = '', public string $validateMessage = '')
    {
    }
}
