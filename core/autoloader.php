<?php

class Autoloader {

    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function loadClass($className)
    {
        $path = __DIR__ . '/../app/' . lcfirst($className) . '.class.php';
        require_once $path;
    }

}