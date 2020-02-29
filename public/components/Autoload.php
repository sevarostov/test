<?php

function __autoload($class_name)
{
    # List all the class directories in the array.
    $array_paths = array(
        '/models/',// подключаются файлы из папки "компоненты" и "модели"
        '/components/',
        '/controllers/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }

    foreach ($array_paths as $path) {
        $path = ROOT . $path . 'component_' . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }

    foreach ($array_paths as $path) {
        $path = ROOT . $path . 'controller_' .$class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }

    }
}



