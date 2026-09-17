<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Footer;

final class FooterData
{
    public function __construct(
        public string $componentElement = 'footer',
        public bool $slotOnly = false,
        public ?string $id = null,
        public string $logotype = '/',
        public string $logotypeHref = '',
        public array $links = [],
        public string $subfooterLogotype = '',
        public mixed $subfooter = null,
        public mixed $prefooter = null,
        public mixed $postfooter = null,
        public mixed $footerareas = null,
    ) {}
}
