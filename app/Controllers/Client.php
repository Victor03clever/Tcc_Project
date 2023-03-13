<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Valida;
use App\Helpers\Url;
use App\Libraries\uploads;
use App\Libraries\Controller;

class  Client  extends Controller
{
    private $Data;
    private $Perfil;
    private $Food;
    private $Request;
    public function __construct()
    {
        $this->Data = $this->model("client\Usuarios");
        $this->Perfil = $this->model("client\Perfil");
        $this->Food = $this->model("client\Home");
        $this->Request = $this->model("client\Request");

    }

    // funcao para chamar os pratos do bd
    public function index()
    {

        if (!Sessao::nivel2()) :
            Url::redireciona('client/login');
        endif;
        $allFood= $this->Food->getFood();
        $totalRequest=$this->Request->totalRequest();
        
        $file = 'homepage';
        return $this->view('layouts/client/app', compact('file','allFood','totalRequest'));
    }


    // Autenticacao do usuario
    public function login()
    {
        if (Sessao::nivel2()) :
            Url::redireciona('client/home');
        endif;
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //  var_dump($formulario);

        if (isset($formulario['login'])) :
            $dados = [
                'nome' => trim($formulario['nome']),
                'senha' => trim($formulario['senha']),
                'erro_nome' => '',
                'erro_senha' => ''
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['nome'])) :
                    $dados['erro_nome'] = "preencha o campo nome";
                endif;

                if (empty($formulario['senha'])) :
                    $dados['erro_senha'] = "preencha o campo senha";
                endif;

            else :

                $checarlogin = $this->Data->checalogin($dados['nome'], $dados['senha'], 0);
                // var_dump($checarlogin);
                // exit;
                if ($checarlogin) :

                    Url::redireciona('client/');
                    $this->criarsessao($checarlogin);
                    Sessao::izitoast('loginS', "{$_SESSION['usuarioC_nome']}", 'Login realizado com sucesso');
                // var_dump($_SESSION);

                else :
                    Sessao::izitoast('loginE', 'Erro', 'Nome ou senha estão errados', 'error');
                    $dados['erro_nome'] = "Dados invalidos";
                    $dados['erro_senha'] = "Dados invalidos";
                endif;



            endif;
        //  var_dump($formulario);
        else :
            $dados = [
                'nome' => '',
                'senha' => '',
                'erro_nome' => '',
                'erro_senha' => ''
            ];
        endif;

        return $this->view('client/makelogin', compact('dados'));
    }

    private function  criarsessao(array $usuario)
    {

        $_SESSION['usuarioC_id'] = $usuario['id'];
        $_SESSION['usuarioC_nome'] = $usuario['nome'];
        $_SESSION['usuarioC_numero'] = $usuario['numero'];
        $_SESSION['usuarioC_img'] = !empty($usuario['imagem']) ? URL . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $usuario['imagem'] : URL . '/public/img/user-logo.jpg';
    }
    public function sair()
    {
        unset($_SESSION['usuarioC_id']);
        unset($_SESSION['usuarioC_nome']);
        unset($_SESSION['usuarioC_email']);
        unset($_SESSION['usuarioC_img']);
        session_destroy();
        Url::redireciona('client/login');
    }

    public function signup()
    {
        if (Sessao::nivel2()) :
            session_destroy();
        endif;
        $formulario = filter_input_array(INPUT_POST,FILTER_DEFAULT);
        if(isset($formulario['cad'])){
            $dados= [
                'nome'=>trim($formulario['nome']),
                'telefone'=>trim($formulario['telefone']),
                'senha'=>trim($formulario['senha']),
                'erro_nome'=>'',
                'erro_telefone'=>'',
                'erro_senha'=>'',
                'imagem'=>'img/user-logo.jpg'
            ];
            if(in_array("",$formulario)){
                if(empty($formulario['nome'])){
                    $dados['erro_nome']= 'Preencha o campo nome*';
                }
                if(empty($formulario['telefone'])){
                    $dados['erro_telefone']= 'Preencha o campo telefone*';
                }
                if(empty($formulario['senha'])){
                    $dados['erro_senha']= 'Preencha o campo senha*';
                }
            }else{
                if(Valida::number($formulario['telefone'])){
                    $dados['erro_telefone']='Preencha corretamente o numero; Angola.';
                }elseif(!Valida::regex($formulario['nome'])){
                    $dados['erro_nome']='Nome Ínvalido; ex: Adilson Simão';
                }elseif($this->Data->checanome($formulario['nome'])){
                    $dados['erro_nome']='Nome já Cadastrado no sistema;';
                    Sessao::izitoast('signup','Error','Insira 1º e ultimo nome inscrito no IPPA','error');
                }else{
                    $dados['senha'] = Valida::pass_segura($formulario['senha']);
                    
                    $cadastrar = $this->Data->storeuser($dados);
                    if($cadastrar){
                        Sessao::izitoast('signup','Sucesso','Cadastrado com sucesso');
                        Url::redireciona('client/login');
                        exit;
                    }else{
                        Sessao::izitoast('signup','Error','Erro com BD','error');
                    }

                }
            }
        }else{
            $dados= [
                'nome'=>'',
                'telefone'=>'',
                'senha'=>'',
                'erro_nome'=>'',
                'erro_telefone'=>'',
                'erro_senha'=>'',
            ];
        }
        return $this->view('client/signup', compact('dados'));
    }



    // Controllers para perfil
    public function config()
    {
        if (!Sessao::nivel2()) :
            Url::redireciona('client/login');
        endif;


        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // // upload de imagem
        if (isset($formulario['load'])) :

            if (isset($_FILES['upload'])) :
                $foto = $this->Perfil->viewperfil($_SESSION['usuarioC_id']);
                unset($_SESSION['usuarioC_nome']);
                $_SESSION['usuarioC_nome'] = $foto['nome'];
                

                $upload = new Uploads();
                $road = "Users" . DIRECTORY_SEPARATOR . $_SESSION['usuarioC_nome'];
                $upload->imagem($_FILES['upload'], 7, $road);
                // var_dump($upload->getexito(), $upload->geterro());


            endif;
            if ($upload->geterro()) :
                Sessao::sms('upload', $upload->geterro(), 'alert alert-danger');
            else :
                $up = [
                    'path' => $_SESSION['path'],
                    'id' => $_SESSION['usuarioC_id']
                ];

                if ($this->Perfil->updateupload($up)) :
                    $foto = $this->Perfil->viewperfil($_SESSION['usuarioC_id']);

                    unset($_SESSION['usuarioC_img']);
                    $_SESSION['usuarioC_img'] = !empty($foto['imagem']) ? URL . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $foto['imagem'] : URL . 'public/img/user-logo.jpg';
                    Sessao::sms('upload', $upload->getexito());
                // Url::redireciona('admin/config');
                else :
                    die("erro ao armazenar o caminho da foto de perfil");
                endif;
            endif;



        endif;

        $readperfil = $this->Perfil->viewperfil($_SESSION['usuarioC_id']);
        // edicao de perfil
        if (isset($formulario['perfil'])) :



            $dados = [
                'nome' => trim($formulario['nome']),
                'telefone' => trim($formulario['telefone']),
                'err_nome' => '',
                'id' => $_SESSION['usuarioC_id'],
                // 'perfil' => $readperfil,
                'err_telefone' => ''

            ];

            if (in_array("", $formulario)) {

                if (empty($formulario['nome'])) :
                    $dados['err_nome'] = 'Preencha o campo Nome*';
                endif;

                if (empty($formulario['telefone'])) :
                    $dados['err_telefone'] = 'Preencha o campo telefone*';
                endif;
                // colloque mensagem
                Sessao::izitoast('config', 'Warning', ' Algo deu errado tente editar novamente', 'warning');
            } else {
                if (Valida::number($formulario['telefone'])) :
                    $dados['err_telefone'] = "preencha corretamente o número:'ANGOLA'";
                    Sessao::izitoast('config', 'Warning', ' Algo deu errado tente editar novamente', 'warning');

                else :

                    if ($this->Perfil->updateperfil($dados)) :
                        Sessao::izitoast('config', 'Success', 'Perfil actualizado com sucesso');

                    else :
                        Sessao::izitoast('config', 'Error', 'Erro com a função->updateperfil', 'error');
                        $dados = [
                            'nome' => $readperfil['nome'],
                            'telefone' => $readperfil['numero'],
                            'err_nome' => '',
                            'err_telefone' => ''
                        ];
                    endif;
                endif;
            }
        else :
            $dados = [
                'nome' => $readperfil['nome'],
                'telefone' => $readperfil['numero'],
                'err_nome' => '',
                'err_telefone' => ''
            ];

        endif;


        // Renovar a senha
        $senha = $this->Perfil->viewperfil($_SESSION['usuarioC_id']);
        // var_dump($senha);
        // exit;
        if (isset($formulario['altSenha'])) :
            $change = [
                'senha' => trim($formulario['senha']),
                'novasenha' => trim($formulario['novasenha']),
                'rnovasenha' => trim($formulario['rnovasenha']),
                'err_senha' => '',
                'err_newpass' => '',
                'err_renewpass' => ''
            ];
            if (in_array("", $formulario)) :
                if (empty($formulario['senha'])) :
                    $change['err_senha'] = 'Preencha o campo*';
                endif;
                if (empty($formulario['novasenha'])) :
                    $change['err_newpass'] = 'Preencha o campo Nova Senha*';
                endif;
                if (empty($formulario['rnovasenha'])) :
                    $change['err_renewpass'] = 'Porfavor repita a Nova Senha*';
                endif;
                Sessao::izitoast('config', 'Warning', 'Algo deu errado, tente a senha novamente','error');

            else :
               
                if (!password_verify($change['senha'], $senha['senha'])) :
                    $change['err_senha'] = 'Senha errada';
                    Sessao::izitoast('config', 'Warning', 'Algo deu errado, tente a senha novamente','error');
                elseif ($formulario['novasenha'] != $formulario['rnovasenha']) :
                    $change['err_newpass'] = 'Senhas diferentes*';
                    $change['err_renewpass'] = 'Senhas diferentes*';
                    Sessao::izitoast('config', 'Warning', 'Algo deu errado, tente a senha novamente','error');
                else :
                    $change['novasenha'] = password_hash(trim($formulario['novasenha']), PASSWORD_DEFAULT);
                    $newpass = $this->Perfil->newpass($change, $_SESSION['usuarioC_id']);
                    if ($newpass) :
                        Sessao::izitoast('config', 'Success', 'Senha actualizado com sucesso');
                        Url::redireciona('client/config');
                        exit;
                    else :
                        Sessao::sms('upload', 'Erro com a Model Usuarios->newpass', 'alert alert-danger');

                    endif;
                endif;
            // var_dump($dados);
            endif;

        else :
            $change = [
                'senha' => '',
                'novasenha' => '',
                'rnovasenha' => '',
                'err_senha' => '',
                'err_newpass' => '',
                'err_renewpass' => ''
            ];
        endif;




        $file = 'config';
        return $this->view('layouts/client/app', compact('file', 'dados', 'change'));
    }
    public function deletetofo()
    {
        if (!Sessao::nivel2()) :
            Url::redireciona('home');
        endif;
        // $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
        $dados = ['id' => $_SESSION['usuarioC_id'], 'path' => 'img/user-logo.jpg'];
        if($this->Perfil->deletefotos($dados)) :
            unset($_SESSION['usuarioC_img']);
            $_SESSION['usuarioC_img'] = URL . '/public/img/user-logo.jpg';

            Sessao::sms('upload', 'imagem deletado com sucesso');
            Url::redireciona('client/config');
        else :
            Sessao::sms('upload', 'imagem não deletado, erro com a Model Perfil->deletefoto', 'alert alert-danger');
        // Url::redireciona('admin/config');
        endif;
    }

    // Function para pedidos
    public function makeRequest(){
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(isset($formulario['status1'])){
            $id=trim($formulario['idgiven']);
            if($this->Food->getFoodByOne($id)){

                $dados = $this->Food->getFoodByOne($id);
                $qtd=trim($formulario['qtd']);

                if($this->Food->makeRequestR($dados,$qtd)){
                    URL::redireciona("client");
                    Sessao::izitoast("pedido","Success","Pedido feito com sucesso");
                }else{
                    URL::redireciona("client");
                    Sessao::izitoast("pedido","Alert","Algo deu errado","warning");
                }
                
            }else{
                URL::redireciona("client");
                Sessao::izitoast("pedido","Alert","Algo deu errado","warning");
            }

        }
    }
}
