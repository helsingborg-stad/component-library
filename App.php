<?php

namespace ComponentLibrary;

class App
{
    public function __construct()
    {
        //Define basepath
        define('BCL_BASEPATH', dirname(__FILE__) . '/');

        //Autload controllers etc
        require_once BCL_BASEPATH . 'vendor/autoload.php';

        //Include base classes
        include BCL_BASEPATH . 'source/php/Init.php';
        include BCL_BASEPATH . 'source/php/Register.php';
        
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
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
