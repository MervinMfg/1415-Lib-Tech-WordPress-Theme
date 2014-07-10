    <?php
        // Figure out what our server name is
        $host = $_SERVER['SERVER_NAME'];
        // check if we are in the dev environment
        if ($host == 'localhost' || $host == 'libtech.dev' || $host == 'libtech1415.staging.wpengine.com') {
            // we're on dev, so include the JavaScript individually for easier debugging
            include 'footer-scripts.php';
            include 'footer-scripts-diy-builder.php';
        } else {
            // if production, provide the compiled and uglified JS files
            echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/_/js/libtech.footer.min.js"></script>' . "\n";
            echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/_/js/libtech.footer-diy-builder.min.js"></script>' . "\n";
        }
    ?>