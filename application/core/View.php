<?php

namespace application\core;

class View {

    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $vars = []) {
        extract($vars);

        if (file_exists($path = 'application/view/'.$this->path.'.php')) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'application/view/layouts/'.$this->layout.'.php';
        } else {
            echo "Вид не найден: $this->path <br>";
        }
    }

    public static function errorCode($code) {
        http_response_code($code);

        if (file_exists($path = 'application/view/errors/'.$code.'.php')) {
            require $path;
        }

        exit();
    }

    public function redirect($url) {
        header("Location: $url");
        exit();
    }

    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url) {
        exit(json_encode(['url' => $url]));
    }
}