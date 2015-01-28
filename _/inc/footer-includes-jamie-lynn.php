    <?php
        // Figure out what our server name is
        $host = $_SERVER['SERVER_NAME'];
        // check if we are in the dev environment
        if ($host == 'localhost' || $host == 'libtech.dev' || $host == 'libtech1415.staging.wpengine.com') {
            // we're on dev, so include the JavaScript individually for easier debugging
            include 'footer-scripts-jamie-lynn.php';
        } else {
            // include script version for file versioning on production environment
            include_once 'script-version.php';
            // if production, provide the compiled and uglified JS files
            echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/_/js/libtech.footer-jamie-lynn.min.js?v=' . $GLOBALS['SCRIPT_VERSION'] . '"></script>' . "\n";
        }
    ?>