<?php

require_once 'File/Iterator/Autoload.php';

class DirectoryHelper
{
    public static function removeRecursively($path) {
        if (!file_exists($path) || (is_dir($path) && preg_match('/\.{1,2}$/', $path))) {
            return true;
        }

        if (is_file($path)) {
            return unlink($path);
        } else {
            $class_func = array(__CLASS__, __FUNCTION__);
            array_map($class_func, glob($path.'/{*,.*}', GLOB_BRACE));
            return rmdir($path);
        }
    }
}
