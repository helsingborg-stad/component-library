<?php

declare(strict_types=1);

use ComponentLibrary\Component\Signature\SignatureData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'signature',
    view: 'signature.blade.php',
    data: SignatureData::class,
);
