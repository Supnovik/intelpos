<?php

include '../config.php';


spl_autoload_register(function ($class) {
    $prefixController = 'Intelpos\\Controller\\';

    $prefixModel = 'Intelpos\\Model\\';

    $base_dir = 'app/';

    $lenController = strlen($prefixController);
    $lenModel = strlen($prefixModel);
    if (strncmp($prefixController, $class, $lenController) == 0) {
        $relative_class = substr($class, $lenController);
        $file = $base_dir.'controllers/'.str_replace('\\', '/', $relative_class).'.php';

        if (file_exists($file)) {
            require $file;
        }
    } else {
        if (strncmp($prefixModel, $class, $lenModel) == 0) {
            $relative_class = substr($class, $lenModel);
            $file = $base_dir.'models/'.str_replace('\\', '/', $relative_class).'.php';
            if (file_exists($file)) {
                require $file;
            }
        } else {
            return;
        }
    }
});