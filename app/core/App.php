<?php

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // mencari controller
        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists('../app/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                return $this->loadNotFoundPage();
            }
            // unset($url[0]);
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // method
        if (isset($url[1])) {
            // Konversi kebab-case ke underscore
            $method = str_replace('-', '_', $url[1]);
            if (method_exists($this->controller, $method)) {
                $this->method = $method;
                unset($url[1]);
            } else {
                // Method tidak ditemukan
                return $this->loadNotFoundPage();
            }
        }

        // params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // Cek jumlah parameter yang dibutuhkan
        try {
            $ref = new ReflectionMethod($this->controller, $this->method);
            $requiredParams = $ref->getNumberOfRequiredParameters();

            if (count($this->params) < $requiredParams) {
                return $this->loadNotFoundPage();
            }

            // Jalankan
            call_user_func_array([$this->controller, $this->method], $this->params);
        } catch (Exception $e) {
            return $this->loadNotFoundPage();
        }

        // jalankan controller, method, dan params
        // call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

    public function loadNotFoundPage()
    {
        require_once '../app/controllers/NotFoundController.php';
        $notFound = new NotFoundController();
        $notFound->index();
        return;
    }
}
