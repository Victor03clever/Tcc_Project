<?php

namespace App\Controllers\admin;

use App\Libraries\Controller;
use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Helpers\Valida;




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

    


    public function index()
    {
        if (Sessao::nivel0()) :
            Url::redireciona('admin/home');
        endif;

        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //  var_dump($formulario);
        if (isset($formulario['btn_log'])) :
            $dados = [
                'nome' => trim($formulario['nome']),
                'senha' => trim($formulario['senha']),
                'erro_nome'=>'',
                'erro_senha'=>''
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['nome'])) :
                    $dados['erro_nome'] = "preencha o campo nome";
                endif;

                if (empty($formulario['senha'])) :
                    $dados['erro_senha'] = "preencha o campo senha";
                endif;

            else :                        
                
                    $checarlogin=$this->Data->checalogin($dados['nome'],$dados['senha'],0);
                    // var_dump($checarlogin);
                    // exit;
                    if ($checarlogin) :
                        
                        Sessao::izitoast('loginS','Bemvindo','Login realizado com sucesso');
                        Url::redireciona('admin/home');
                        $this->criarsessao($checarlogin);
                        // var_dump($_SESSION);
                        
                    else :
                        Sessao::izitoast('loginE','Erro','Nome ou senha estão errados','error');
                        $dados['erro_nome'] = "Dados invalidos";
                        $dados['erro_senha'] = "Dados invalidos";
                    endif;
                        
               

            endif;
        //  var_dump($formulario);
        else :
            $dados = [
                'nome' => '',
                'senha' => '',
                'erro_nome'=>'',
                'erro_senha'=>''
            ];
        endif;
 

        
       return $this->view('admin/login', compact('dados'));
    }
    private function  criarsessao(array $usuario){
        
        $_SESSION['usuarios_id']= $usuario['usuario_id'];
        $_SESSION['usuarios_nome']= $usuario['u_nome'];
        $_SESSION['usuarios_email']= $usuario['email'];
        $_SESSION['usuarios_img']= !empty($usuario['imagem'])?URL.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$usuario['imagem']:URL.'/public/img/user-logo.jpg';
       
    }
    public function sair(){
        unset($_SESSION['usuarios_id']);
        unset($_SESSION['usuarios_nome']);
        unset($_SESSION['usuarios_email']);
        unset($_SESSION['usuarios_img']);
        session_destroy();
        Url::redireciona('admin/login');
    }

    
}