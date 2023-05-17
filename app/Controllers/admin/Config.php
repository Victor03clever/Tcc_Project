<?php

namespace App\Controllers\admin;

use App\Helpers\Sessao;
use App\Helpers\Valida;
use App\Helpers\Url;
use App\Libraries\uploads;
use App\Libraries\Controller;

class Config extends Controller
{
    private $Data;
    public function __construct()
    {
        if (Sessao::nivel1()) :
            session_destroy();
            Url::redireciona('home');
        endif;
        $this->Data = $this->model("admin\Perfil");
    }

    // Controllers para perfil
    public function index()
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;


        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        // upload de imagem
        if (isset($formulario['load'])) :
            if (isset($_FILES['upload'])) :
                $foto = $this->Data->viewperfil($_SESSION['usuarios_id']);
                unset($_SESSION['usuarioC_nome']);
                $_SESSION['usuarios_email'] = $foto['email'];

                $upload = new Uploads();
                $road = "Users" . DIRECTORY_SEPARATOR . $_SESSION['usuarios_email'];
                $upload->imagem($_FILES['upload'], 7, $road);
            // var_dump($upload->getexito(),$upload->geterro());
            endif;
            if ($upload->geterro()) :
                Sessao::sms('upload', $upload->geterro(), 'alert alert-danger');
            else :
                $up = [
                    'path' => $_SESSION['path'],
                    'id' => $_SESSION['usuarios_id']
                ];

                if ($this->Data->updateupload($up)) :
                    $foto = $this->Data->viewperfil($_SESSION['usuarios_id']);

                    unset($_SESSION['usuarios_img']);
                    $_SESSION['usuarios_img'] = !empty($foto['imagem']) ? URL . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $foto['imagem'] : URL . 'public/img/user-logo.jpg';
                    Sessao::sms('upload', $upload->getexito());
                // Url::redireciona('admin/config');
                else :
                    die("erro ao armazenar o caminho da foto de perfil");
                endif;
            endif;



        endif;
        $readperfil = $this->Data->viewperfil($_SESSION['usuarios_id']);
        // edicao de perfil

        if (isset($formulario['cad'])) :
            
            $dados = [
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'err_nome' => '',
                'id' => $_SESSION['usuarios_id'],
                'perfil' => $readperfil,
                'err_email' => ''

            ];
            if (in_array("", $formulario)) :

                if (empty($formulario['nome'])) :
                    $dados['err_nome'] = 'Preencha o campo Nome*';
                endif;

                if (empty($formulario['email'])) :
                    $dados['err_email'] = 'Preencha o campo Email*';
                endif;
                // colloque mensagem
                Sessao::izitoast('config', 'Warning', ' Algo deu errado tente editar novamente', 'warning');


            else :
                if (Valida::email($formulario['email'])) :
                    $dados['err_email'] = "preencha corretamente o email";
                    Sessao::izitoast('config', 'Warning', ' Algo deu errado tente editar novamente', 'warning');

                else :
                    // var_dump($dados);
                    // exit;
                    if ($this->Data->updateperfil($dados)) :
                        Sessao::izitoast('config', 'Success', 'Perfil actualizado com sucesso');

                    else :
                        Sessao::izitoast('config', 'Error', 'Erro com a função->updateperfil', 'error');
                        $dados = [
                            'nome' => $readperfil['nome'],
                            'email' => $readperfil['email'],
                            'err_nome' => '',
                            'err_email' => ''
                        ];
                    endif;
                endif;

            endif;
        else :
            $dados = [
                'nome' => $readperfil['nome'],
                'email' => $readperfil['email'],
                'err_nome' => '',
                'err_email' => ''
            ];
        
        endif;
        // Renovar a senha
        $senha = $this->Data->viewperfil($_SESSION['usuarios_id']);
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
                // echo'<hr>';
                // var_dump($change);
                // exit;
                if (!password_verify($change['senha'], $senha['senha'])) :
                    $change['err_senha'] = 'Senha errada';
                    Sessao::izitoast('config', 'Warning', 'Algo deu errado, tente a senha novamente','error');
                elseif ($formulario['novasenha'] != $formulario['rnovasenha']) :
                    $change['err_newpass'] = 'Senhas diferentes*';
                    $change['err_renewpass'] = 'Senhas diferentes*';
                    Sessao::izitoast('config', 'Warning', 'Algo deu errado, tente a senha novamente','error');
                else :
                    $change['novasenha'] = password_hash(trim($formulario['novasenha']), PASSWORD_DEFAULT);
                    $newpass = $this->Data->newpass($change, $_SESSION['usuarios_id']);
                    if ($newpass) :
                        Sessao::izitoast('config', 'Success', 'Senha actualizado com sucesso');
                        Url::redireciona('admin/config');
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
        return $this->view('layouts/admin/app', compact('file', 'dados','change'));
    }
    public function deletetofo()
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        // $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
        $dados = ['id' => $_SESSION['usuarios_id'], 'path' => 'img/user-logo.jpg'];
        if ($this->Data->deletefotos($dados)) :
            $_SESSION['usuarios_img'] = URL . '/public/img/user-logo.jpg';

            Sessao::sms('upload', 'imagem deletada com sucesso');
            Url::redireciona('admin/config');
        else :
            Sessao::sms('upload', 'imagem não deletada, erro com a Model Perfil->deletefoto', 'alert alert-danger');
        // Url::redireciona('admin/config');
        endif;
    }
   
}
