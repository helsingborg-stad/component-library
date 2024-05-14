<?php

namespace ComponentLibrary\Helper;

use ComponentLibrary\Cache\CacheInterface;

class Icons {
    private $customIconsSvgsKey = 'icons';

    public function __construct(private CacheInterface $cache){}

    public function getIcons():array
    {
        if (!empty($this->cache->get($this->customIconsSvgsKey))) {
            return $this->cache->get($this->customIconsSvgsKey);
        }

        $icons = $this->getSvgFilesContents($this->getIconSvgFilePaths());
        $this->cache->set($this->customIconsSvgsKey, $icons);

        return $this->cache->get($this->customIconsSvgsKey);
    }

    private function getSvgFilesContents(array $files):array
    {
        if (empty($files)) {
            return [];
        }

        $svgFiles = [];
        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $svgFiles[$name] = file_get_contents($file);
        }

        return $svgFiles;
    }

    private function getIconSvgFilePaths():array
    {
        if (function_exists('apply_filters')) {
            $svgFiles = apply_filters(
                'ComponentLibrary\Component\Icon\CustomSvgIcons',
                glob(__DIR__ . '/Svg/*.svg')
            );
            
        } else {
            $svgFiles = glob(__DIR__ . '/Svg/*.svg');
        }

        return $svgFiles;
    }
}