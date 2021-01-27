<?php

namespace (#plugin_namespace#);

class App
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
        wp_register_style('(#plugin_slug#)-css', (#plugin_cap#)_URL . '/dist/' . \(#plugin_namespace#)\Helper\CacheBust::name('css/(#plugin_slug#).css'));
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
        wp_register_script('(#plugin_slug#)-js', (#plugin_cap#)_URL . '/dist/' . \(#plugin_namespace#)\Helper\CacheBust::name('js/(#plugin_slug#).js'));
    }
}
