<?php

declare(strict_types=1);

namespace ComponentLibrary\Assets;

/** Collects assets during rendering and emits each URL once in plain PHP pages. */
class PhpAssetEnqueuer implements AssetEnqueuerInterface
{
    private array $componentStyles = [];
    private array $componentScripts = [];
    private array $styles = [];
    private array $scripts = [];
    private array $utilityDefinitions = [];
    private array $utilities = [];

    public function registerComponent(string $slug, ?string $styleUrl = null, ?string $scriptUrl = null): void
    {
        if ($styleUrl !== null) {
            $this->componentStyles[$slug] = $styleUrl;
        }
        if ($scriptUrl !== null) {
            $this->componentScripts[$slug] = $scriptUrl;
        }
    }

    public function enqueueComponent(string $slug, array $dependencies = []): void
    {
        foreach ($dependencies['sass']['components'] ?? [] as $dependency) {
            if (is_string($dependency) && $dependency !== $slug) {
                $this->enqueueComponent($dependency);
            }
        }
        if (isset($this->componentStyles[$slug])) {
            $this->enqueueStyle('component-' . $slug, $this->componentStyles[$slug]);
        }
        if (isset($this->componentScripts[$slug])) {
            $this->enqueueScript('component-' . $slug, $this->componentScripts[$slug]);
        }
        foreach ($dependencies['utilities'] ?? [] as $utility) {
            if (is_string($utility)) {
                $this->enqueueUtility($utility);
            }
        }
    }

    public function registerUtility(string $name, string $url, int $order = 0): void
    {
        $this->utilityDefinitions[$name] = ['url' => $url, 'order' => $order];
    }

    public function enqueueUtility(string $name): void
    {
        if (isset($this->utilityDefinitions[$name])) {
            $this->utilities[$name] = $this->utilityDefinitions[$name];
        }
    }

    public function enqueueStyle(string $handle, string $url): void
    {
        $this->styles[$handle] = $url;
    }

    public function enqueueScript(string $handle, string $url): void
    {
        $this->scripts[$handle] = $url;
    }

    public function renderStyles(): string
    {
        $utilities = $this->utilities;
        uasort($utilities, static fn (array $a, array $b): int => $a['order'] <=> $b['order']);
        return implode("\n", array_map(
            static fn (string $url): string => '<link rel="stylesheet" href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '">',
            array_values(array_unique(array_merge(array_values($this->styles), array_column($utilities, 'url')))),
        ));
    }

    public function renderScripts(): string
    {
        return implode("\n", array_map(
            static fn (string $url): string => '<script type="module" src="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '"></script>',
            array_values(array_unique($this->scripts)),
        ));
    }
}
