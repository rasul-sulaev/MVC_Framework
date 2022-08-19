<?php

namespace application\core;

abstract class Controller {
    public $route;
    public $view;
    public $model;
    public $acl;

    public function __construct($route) {
        $this->route = $route;
        $this->checkAcl();
        if (!$this->checkAcl()) {
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModels($route['controller']);

    }

    public function loadModels($name) {
        if (class_exists($path = 'application\models\\'.ucfirst($name))) {
            return new $path;
        }
    }

    public function checkAcl() {
        if (file_exists($acl = 'application/acl/'.$this->route['controller'].'.php')) {
            $this->acl = require $acl;

            if ($this->isAcl('all')) {
                return true;
            } elseif (!isset($_SESSION['auth']['id']) && $this->isAcl('guest')) {
                return true;
            } elseif (isset($_SESSION['auth']['id']) && $this->isAcl('auth')) {
                return true;
            } elseif (isset($_SESSION['admin']) && $this->isAcl('admin')) {
                return true;
            }
            return false;
        }
    }

    public function isAcl($key) {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}