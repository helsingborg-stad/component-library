<?php
    //Define basepath
    define('BCL_BASEPATH', dirname(__FILE__) . '/');

    //Autload controllers etc
    if(file_exists(BCL_BASEPATH . 'vendor/autoload.php')) {
        require_once BCL_BASEPATH . 'vendor/autoload.php';
    }

    //Include base classes (TODO: Use autoload instead)
    require_once BCL_BASEPATH . 'source/php/Init.php';
    require_once BCL_BASEPATH . 'source/php/Register.php';
    require_once BCL_BASEPATH . 'source/library/component-library.php';