<?php

namespace App\Libraries;

class Router
{
    private string $url;
    private array $url1;
    private array $url0;
    private array $uri;
    private  $controller;
    private $metodo = "index";
    private $parametros = [];


    public function __construct()
    {
        $url = $this->url() ?? [0];


        if (file_exists(dirname(__DIR__) . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . ucwords($url[0]) . ".php")) {

            $this->controller = ucwords($url[0]);
            unset($url[0]);
            $carregar = "\\App\\Controllers\\" . $this->controller;
            $this->controller = new $carregar;
        } elseif (file_exists(dirname(__DIR__) . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . ucwords($url[1]) . ".php")) {
            $this->controller = ucwords($url[1]);
            unset($url[1]);
            $carregar = "\\App\\Controllers\\admin\\" . $this->controller;
            $this->controller = new $carregar;
        } elseif (isset($url[0])) {
            if (empty($url[0])) {
                $this->controller = ucwords("home");
                $carregar = "\\App\\Controllers\\" . $this->controller;
                $this->controller = new $carregar;
            } else {
                $this->controller = "Error";
                $carregar = "\\App\\Controllers\\" . $this->controller;
                $this->controller = new $carregar;
            }
        } elseif (!isset($url[0])) {
            if (empty($this->url1[1])) :
                $this->controller = ucwords('login');
                $carregar = "\\App\\Controllers\\admin\\" . $this->controller;
                $this->controller = new $carregar;

            else :
                $this->controller = "Error";
                $carregar = "\\App\\Controllers\\" . $this->controller;
                $this->controller = new $carregar;
            endif;
        } elseif (!file_exists(dirname(__DIR__) . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . ucwords($url[0]) . ".php")  and  !file_exists(dirname(__DIR__) . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . ucwords($url[1]) . ".php")) {
            $this->controller = "Error";
            $carregar = "\\App\\Controllers\\" . $this->controller;
            $this->controller = new $carregar;
        }


        // if (isset($url[0])) {
            if (isset($url[1])) {
                if (method_exists($this->controller, $url[1])) :
                    $this->metodo = $url[1];
                    unset($url[1]);
                endif;
            // }
        } else {
            if (isset($url[2])) {
                if (method_exists($this->controller, $url[2])) :
                    $this->metodo = $url[2];
                    unset($url[2]);
                endif;
            }
        }

        $this->parametros = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->metodo], $this->parametros);
    }


    private function url()
    {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL))) :
            $this->url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $this->url = trim(rtrim($this->url));
            $this->url1 = explode('/', $this->url);
            if (ucwords($this->url1[0]) == 'Admin') :
                unset($this->url1[0]);
            endif;
            // $this->url0 = explode('admin/', $this->url);
            $this->uri = $this->url1;
            return $this->uri;
        endif;
    }
}
