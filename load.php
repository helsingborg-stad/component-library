<?php

/**
 * Class ComponentLibraryAutoLoad
 * 
 * This class is responsible for autoloading the Component Library.
 */
Class ComponentLibraryAutoLoad {

    /**
     * ComponentLibraryAutoLoad constructor.
     * 
     * Initializes the autoloader if it is not already loaded.
     */
    public function __construct() {
        if(!$this->isLoaded() && $this->autoloadExists()) {
            $this->load();
        }
    }

    /**
     * Get the path of a file or directory.
     * 
     * @param string $append (optional) The path to append to the base path.
     * @return string The full path.
     */
    private function getPath(string $append = ''): string
    {
        return dirname(__FILE__) . '/' . $append; 
    }

    /**
     * Check if the Component Library is already loaded.
     * 
     * @return bool True if the Component Library is loaded, false otherwise.
     */
    private function isLoaded(): bool
    {
        return class_exists('ComponentLibrary\Init');
    }

    /**
     * Check if the autoloader file exists.
     * 
     * @return bool True if the autoloader file exists, false otherwise.
     */
    private function autoloadExists(): bool
    {
        return file_exists($this->getPath('vendor/autoload.php'));
    }

    /**
     * Load the Component Library.
     * 
     * @return bool True if the Component Library is successfully loaded, false otherwise.
     */
    private function load(): void
    {
        require_once $this->getPath('vendor/autoload.php');
    }
}

new ComponentLibraryAutoLoad();