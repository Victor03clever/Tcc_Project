<?php

namespace App\Http;

class Request
{
    /**
     * Metodo Http da requisição
     * @var string
     */

    private $httpMethod;

    /**
     * URI da pagina
     * @var string
     */
    private $uri;

    /**
     * Parametros da URL ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Variaveis recebidas no POST da pagina ($_POST)
     * @var array
     */
    private $postvars = [];

    /**
     * Cabecalhos da requisicao
     * @var array
     */
    private $headers = [];

    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->postvars = $_POSTP ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    /**
     * Metodo responsavel por retornar o metodo Http da requisicao
     * @var string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Metodo responsavel por retornar a Uri da requisicao
     * @var string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Metodo responsavel por retornar os parametros da Url da requisicao
     * @var array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * Metodo responsavel por retornar os cabecalhos requisicao
     * @var array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
    /**
     * Metodo responsavel por retornar as variaveis post da  requisicao
     * @var array
     */
    public function getPostVars()
    {
        return $this->postvars;
    }
}
