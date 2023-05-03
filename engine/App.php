<?php

namespace app\engine;

use app\traits\TSingletone;
use app\engine\Db;
use app\engine\Storage;
use app\engine\Request;


class App {

    use TSingletone;

    public $config;
    private $components;

    private $controller;
    private $action;

    public function run($config) {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    } 

    public function runController() {

        $this->controller = $this->request->getControllerName() ?: 'product';
        $this->action = $this->request->getActionName();

        $controllerClass = $this->config['controllers_namespace'] . ucfirst($this->controller) . "Controller";
        
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new TwigRender());
            //$controller = new $controllerClass(new Render());
            $controller->runAction($this->action);
        } else {
            echo "Не правильный контроллер!";
        }
    }

    public static function call() {
        return static::getInstance();
    }

    public function createComponent($name) {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);
            }
        }
        return null;
    }

    public function __get($name) {
        return $this->components->get($name); 
     }

}