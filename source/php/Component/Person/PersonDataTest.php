<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Person;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class PersonDataTest extends TestCase
{
    public function testTypedConfigDescribesThePersonContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(PersonData::class);
        $types = $reflector->getArgumentTypes(PersonData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('person', $config->slug);
        static::assertSame(PersonData::class, $config->data);
        static::assertFalse($defaults['familyName']);
        static::assertSame('string|boolean', $types['familyName']);
    }
}