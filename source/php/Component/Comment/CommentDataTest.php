<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Comment;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class CommentDataTest extends TestCase
{
    public function testTypedConfigDescribesTheCommentContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(CommentData::class);
        $types = $reflector->getArgumentTypes(CommentData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('comment', $config->slug);
        static::assertSame(CommentData::class, $config->data);
        static::assertFalse($defaults['actions']);
        static::assertSame('object|boolean', $types['actions']);
    }
}
