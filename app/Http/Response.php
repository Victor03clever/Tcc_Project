<?php

namespace App\Http;

class Response
{
    /**
     * Codigo do status do http
     * @var integer
     */
    private $httpCode = 200;

    /**
     * cabecalhos dos response
     * @var array
     */
    private $Headers = [];

    /**
     * tipo de conteudo que esta sendo retornando
     * @var string
     */
    private $contentType = 'text/html';
 
    /**
     * conteudo da response
     * @var mixed
     */
    private $Content ;

    /**
     * Metodo responsavel por iniciar as classes e definir valores
     * @param integer $httpcode
     * @param mixed $content
     * @param string $contenttype
     */
    public function __construct($httpcode, $content, $contenttype = 'text/html')
    {
        $this->httpCode=$httpcode;
        $this->Content=$content;
        $this->setContentType($contenttype);
    }

    public function setContentType($contenttype)
    {
        $this->contentType = $contenttype;
        $this->addHeader('Content-Type',$contenttype);
    }

    public function addHeader($key ,$value)
    {
        $this->Headers[$key]=$value;
    }

    private function sendHeaders()
    {
        //status
        http_response_code($this->httpCode);

        //enviar headers
        foreach($this->Headers as $key=>$value)
        {
            header($key.': '.$value);
        }
    } 

    public function sendResponse()
    {
        //envia os headers
        $this->sendHeaders();
        // imprima os conteudos
        switch ($this->contentType) {
            case 'text/html':
                echo $this->Content;
               exit;
        }
    }
}