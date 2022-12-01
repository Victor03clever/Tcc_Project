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
        if (Sessao::nivel1()) :
            session_destroy();
            Url::redireciona('home');
        endif;
    }

    public function exemplo()
    
    {
    
        $file='php'; 
        print $this->view('layouts/admin/app',compact('file'));
        
    }


    public function index()
    {
        if (Sessao::nivel0()) :
            Url::redireciona('admin/home');
        endif;

        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //  var_dump($formulario);
        if (isset($formulario['btn_log'])) :
            $dados = [
                'login' => trim($formulario['login']),
                'senha' => trim($formulario['senha']),
                'erro_login'=>'',
                'erro_senha'=>''
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['login'])) :
                    $dados['erro_login'] = "preencha o campo login";
                endif;

                if (empty($formulario['senha'])) :
                    $dados['erro_senha'] = "preencha o campo senha";
                endif;

            else :
               
                    $checarlogin=$this->Data->checalogin($dados['login'],$dados['senha'],0);
                    var_dump($checarlogin);
                    // if ($checarlogin) :
                    //     Sessao::sms('usuarios','Login realizado com sucesso');
                        
                    //     Url::redireciona('admin/home');
                    //     $this->criarsessao($checarlogin);
                    //     // var_dump($_SESSION);
                        
                    // else :
                    //     Sessao::sms('usuario','Dados Invalidos','alert alert-danger');
                    //     $dados['erro_login'] = "Dados invalidos";
                    //     $dados['erro_senha'] = "Dados invalidos";
                    // endif;
                        
               

            endif;
         var_dump($formulario);
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
        $_SESSION['usuarios_login']= $usuario['login'];
        $_SESSION['usuarios_email']= $usuario['email'];
       
    }
    public function sair(){
        unset($_SESSION['usuarios_id']);
        unset($_SESSION['usuarios_nome']);
        unset($_SESSION['usuarios_login']);
        unset($_SESSION['usuarios_email']);
        session_destroy();
        Url::redireciona('admin/login');
    }

    
}