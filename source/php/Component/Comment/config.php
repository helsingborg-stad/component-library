<?php

declare(strict_types=1);

use ComponentLibrary\Component\Comment\CommentData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'comment',
    view: 'comment.blade.php',
    data: CommentData::class,
    dependencies: ['sass' => ['components' => ['comment', 'avatar', 'typography', 'link']]],
);
