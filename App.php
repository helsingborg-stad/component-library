<?php

namespace ComponentLibrary;

class App
{
    public function __construct()
    {   
        if(function_exists('add_action')) {
            //add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
            //add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
        }
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
        wp_register_style('component-library-css', COMPONENTLIBRARY_URL . '/dist/' . \ComponentLibrary\Helper\CacheBust::name('css/component-library.css'));
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
        wp_register_script('component-library-js', COMPONENTLIBRARY_URL . '/dist/' . \ComponentLibrary\Helper\CacheBust::name('js/component-library.js'));
    }
}
