<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;

class Router
{
    private $url = '';
    private $prefix = '';
    private $routes = [];
    private $request;

    public function __construct($url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }
    private function setPrefix()
    {
        //Informacoes da url actual
        $parseUrl = parse_url($this->url);

        // definindo prefixo
        $this->prefix = $parseUrl['path'] ?? '';
    }

    private function addRoute($method, $route, $params = [])
    {

        //validacao dos parametros
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        $params['variables'] = [];

        $patternVariables = '/{(.*?)}/';
        if(preg_match_all($patternVariables, $route, $matches))
        {
            $route=preg_replace($patternVariables,'(.*?)',$route);
            $params['variables']= $matches[1];
        
        }

        //padrao de validacao da url
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';
        //adiciona a rota dentro classe
        $this->routes[$patternRoute][$method] = $params;

       
    }

    public function get($route, $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }
    public function post($route, $params = [])
    {
        return $this->addRoute('POST', $route, $params);
    }
    public function put($route, $params = [])
    {
        return $this->addRoute('PUT', $route, $params);
    }
    public function delete($route, $params = [])
    {
        return $this->addRoute('DELETE', $route, $params);
    }

    private function getUri()
    {
        $uri= $this->request->getUri();
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri): [$uri];
        return end($xUri);
        
    }

    private function getRoute()
    {
        $uri = $this->getUri();
        
        $httMethod = $this->request->getHttpMethod();
        // valida as rotas
        foreach($this->routes as $patternRoute=>$method)
        {
            //verifica se a url esta padronizada
            if(preg_match($patternRoute,$uri,$matches))
            {
                
                //verifica o metodo
                if(isset($method[$httMethod]))
                {
                    unset($matches[0]);
                    $keys = $method[$httMethod]['variables'];
                    $method[$httMethod]['variables']= array_combine($keys, $matches);
                    $method[$httMethod]['variables']['request']= $this->request;
                    // retorno dos parametros da rotas
                    return $method[$httMethod];
                }
                throw new Exception("Metodo nao e permitido",405); 
            }
        }
        throw new Exception("URL nao encontrada",404);
    }

    public function run()
    {
        try {
            $route = $this->getRoute();
            
        // echo '<pre>';
        // print_r($route);
        // echo '</pre>';
            
            if(!isset($route['controller']))
            {
                throw new Exception("A controller nao pode ser processado",500);
            }
            $args=[];

            $reflection= new ReflectionFunction($route['controller']);
            foreach($reflection->getParameters() as $parameter)
            {
                $name = $parameter->getName();
                $args[$name]= $route['variables'][$name]??'';
            }
            // echo '<pre>';
            //      print_r($args);
            //      echo '</pre>';
            return call_user_func_array($route['controller'],$args);
        
            
        } catch (Exception $th) {
            return new Response($th->getCode(), $th->getMessage());
        }
    }
}
