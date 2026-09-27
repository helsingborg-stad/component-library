<?php

declare(strict_types=1);

namespace ComponentLibrary\Assets;

/** The host decides how component assets are enqueued (HTML, WordPress, etc.). */
interface AssetEnqueuerInterface
{
    public function enqueueComponent(string $slug, array $dependencies = []): void;

    public function enqueueUtility(string $name): void;

    public function enqueueStyle(string $handle, string $url): void;

    public function enqueueScript(string $handle, string $url): void;
}
