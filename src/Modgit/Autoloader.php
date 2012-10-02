<?php

namespace Modgit;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(array(new self(), 'load'));
    }

    public function load($class)
    {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $full_path = dirname(__DIR__) . DIRECTORY_SEPARATOR . $class . '.php';
        if (is_file($full_path)) {
            require_once $full_path;
        }
    }

}
