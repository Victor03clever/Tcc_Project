<?php

namespace App\Controllers\admin;

use App\Libraries\Controller;
use App\Helpers\Sessao;
use App\Helpers\Url;

use function App\Helpers\asset;


class Login extends Controller
{
    private $Data;
    public function __construct()
    {
        $this->Data = $this->model("admin\Usuarios");
    }

    public function exemplo()
    
    {
    
        $file='php'; 
        print $this->view('layouts/admin/app',compact('file'));
        
    }


    public function index()
    {
        if (Sessao::nivel1()) :
            
            Url::redireciona('home');
        endif;

        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
         var_dump($formulario);
        if (isset($formulario['login'])) :
            $dados = [
                'login' => trim($formulario['login']),
                'senha' => trim($formulario['senha']),
                'erro_login'=>'',
                'erro_senha'=>''
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['login'])) :
                    $dados['erro_email'] = "preencha o campo login";
                endif;

                if (empty($formulario['senha'])) :
                    $dados['erro_senha'] = "preencha o campo senha";
                endif;

            else :
               
                    $checarlogin=$this->Data->checalogin($dados['login'],$dados['senha'],0);
                    if ($checarlogin) :
                        Sessao::mensagem('usuarios','Login realizado com sucesso');
                        
                        $this->criarsessao($checarlogin);
                        Url::redireciona('admin/home');
                        // var_dump($_SESSION);
                        
                    else :
                        Sessao::mensagem('usuario','Dados Invalidos','alerta');
                        $dados['erro_login'] = "Dados invalidos";
                        $dados['erro_senha'] = "Dados invalidos";
                    endif;
                        
               

            endif;
        //  var_dump($formulario);
        else :
            $dados = [
                'login' => '',
                'senha' => '',
                'erro_login'=>'',
                'erro_senha'=>''
            ];
        endif;


        $file='login';
       return $this->view('layouts/admin/app', compact('file','dados'));
    }
    private function  criarsessao($usuario){
        
        $_SESSION['usuarios_id']= $usuario['id'];
        $_SESSION['usuarios_nome']= $usuario['nome'];
        $_SESSION['usuarios_login']= $usuario['email'];
       
    }
    public function sair(){
        unset($_SESSION['usuarios_id']);
        unset($_SESSION['usuarios_nome']);
        unset($_SESSION['usuarios_login']);
        session_destroy();
        Url::redireciona('admin/login');
    }

    
}