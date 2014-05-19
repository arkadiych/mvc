<?php

require_once __DIR__ . '/autoloader.php';
require_once __DIR__ . '/view.php';
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/response.php';

class Bootstrap {

    public function __construct()
    {
        $autoloader = new Autoloader();
        $autoloader->register();

        $defaultModuleName = "default";
        $defaultActionName = "index";

        $uri = $_SERVER['REQUEST_URI'];
        $path = explode('/', $uri);
        array_shift($path);

        $moduleName = !empty($path[0]) ? $path[0] : $defaultModuleName;
        $actionName = !empty($path[1]) ? $path[1] : $defaultActionName;

        $params = array();
        if(count($path) > 2) {
            $params = array_slice($path, 2);
        }

        if(empty($moduleName) && count($path) > 1) {
            throw new Exception("invalid path");
        }

        if(empty($actionName) && count($path) > 2) {
            throw new Exception("invalid path");
        }

        $moduleName = ucfirst($moduleName)."Controller";
        if(class_exists($moduleName)) {
            $view = new View;
            $module = new $moduleName($view);
            $actionName = "execute".ucfirst($actionName);
            if(method_exists($module, $actionName)) {
                $response = $module->$actionName($params);
                echo $response->getOutput();
            } else {
                throw new Exception("invalid method");
            }
        } else {
            throw new Exception("invalid class");
        }
    }

}