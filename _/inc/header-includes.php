<?php
    // Figure out what our server name is
    $host = $_SERVER['SERVER_NAME'];
    // check if we are in the dev environment
    if ($host == 'localhost' || $host == 'libtech.dev') {
        // we're on dev, so include the dev CSS file and JavaScript individually for easier debugging
        echo '<link href="' . get_template_directory_uri() . '/_/compiled/libtech.main.css" rel="stylesheet" type="text/css" />' . "\n";
        include 'header-scripts.php';
    } else if ($host == 'libtech1415.staging.wpengine.com') {
        // we're on dev, so include the dev CSS file and JavaScript individually for easier debugging
        echo '<link href="' . get_template_directory_uri() . '/_/css/libtech.main.css" rel="stylesheet" type="text/css" />' . "\n";
        include 'header-scripts.php';
    } else {
        // include script version for file versioning on production environment
        include_once 'script-version.php';
        // if production, provide the minified CSS and compiled/uglified JavaScript files
        echo '<link href="' . get_template_directory_uri() . '/_/css/libtech.main.min.css?v=' . $GLOBALS['SCRIPT_VERSION'] . '" rel="stylesheet" type="text/css" />' . "\n\t";
        echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/_/js/libtech.header.min.js?v=' . $GLOBALS['SCRIPT_VERSION'] . '"></script>' . "\n";
    }
?>