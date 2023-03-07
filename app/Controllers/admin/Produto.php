<?php

namespace App\Controllers\admin;

use App\Helpers\Sessao;
use App\Helpers\Valida;
use App\Helpers\Url;
use App\Libraries\uploads;
use App\Libraries\Controller;

class Produto extends Controller
{
    private $Data;
    private $Cat;
    public function __construct()
    { 
        $this->Data = $this->model("admin\Produto");
        $this->Cat = $this->model("admin\Categoria");
        if (Sessao::nivel1()) :
            session_destroy();
            Url::redireciona('home');
        endif;
    }
    public function index()
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;

        $dados = $this->Data->read_p();
        // var_dump($dados);
        // exit;
        $file = 'produto' . DIRECTORY_SEPARATOR . 'produto';
        return $this->view('layouts/admin/app', compact('file', 'dados'));
    }
    public function create()
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;

        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);



        if (isset($formulario['store'])) :

            $dados = [
                'name' => trim($formulario['name']),
                'value' => trim($formulario['value']),
                'code' => trim($formulario['code']),
                'upload'=>trim($formulario['upload']),
                'cat' => trim($formulario['cat']),
                'err_name' => '',
                'err_value' => '',
                'err_code' => '',
                'err_img' => '',
                'err_cat' => '',
                'read_c' => $this->Cat->read_c()
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['name'])) :
                    $dados['err_name'] = "Digite o nome do produto";
                endif;

                if (empty($formulario['value'])) :
                    $dados['err_value'] = "Informe o preço do produto";
                endif;
                if (empty($formulario['code'])) :
                    $dados['err_code'] = "Forneça o codigo de barra";
                endif;
                if (empty($formulario['cat'])) :
                    $dados['err_cat'] = "A categoria não pode estar vazia";
                endif;
                if (empty($formulario['upload'])) :
                    $dados['err_img'] = "Escolha a imagem para o produto";
                endif;
                
                else :

                if ($this->Data->checa_nome($formulario['name'])) :
                    $dados['err_name'] = "nome já cadastrado";
                elseif (Valida::length_nome($formulario['name'])) :
                    $dados['err_name'] = "máximo 100 dígitos";


                else :
                    if (isset($_FILES['upload'])) :
                        $upload = new Uploads();
                        $categoria = $this->Cat->read1_c($dados['cat']);
                        $upload->imagem($_FILES['upload'], 7, 'Produtos' . DIRECTORY_SEPARATOR . $categoria['nome']);


                    endif;
                    $imagem = !empty($_SESSION['path']) ?$_SESSION['path']: 'uploads\Produtos\exemplo.jpg';

                    if ($upload->getexito()) :
                        

                        $cadastrar = $this->Data->store_p($dados, $imagem);
                        if ($cadastrar) :

                            Sessao::izitoast('produto', 'success','Produto cadastrado com sucessso');
                            Sessao::sms('upload', $upload->getexito() . ' movida com sucesso');
                            Url::redireciona('admin/produto');

                            exit;
                        else :
                            Sessao::izitoast('produto', 'erro','Erro com banco de dados', 'error');

                        endif;
                    else :
                        if ($upload->geterro())
                            Sessao::sms('upload', $upload->geterro(), 'alert alert-danger');
                    endif;

                endif;


            endif;

        else :
            $dados = [
                'name' => '',
                'value' => '',
                'code' => '',
                'upload'=>trim($formulario['upload']),
                'cat' => $this->Cat->read_c(),
                'err_name' => '',
                'err_value' => '',
                'err_code' => '',
                'err_img' => '',
                'err_cat' => '',
                'read_c' => $this->Cat->read_c()
            ];
        endif;
        $file = 'produto' . DIRECTORY_SEPARATOR . 'cadastrar_produto';
        return $this->view('layouts/admin/app', compact('file', 'dados'));
    }
    public function edit($id)
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id) :
            $edit = $this->Data->edit_p($id);
        // var_dump($edit);
        // exit;
            $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (isset($formulario['edit'])) :
                $imagem = !empty($_SESSION['path']) ?$_SESSION['path']: 'uploads\Produtos\exemplo.jpg';
                $dados = [
                    'name' => trim($formulario['name']),
                    'value' => trim($formulario['value']),
                    'code' => trim($formulario['code']),
                    'path' => $imagem,
                    'cat' => trim($formulario['cat']),
                    'err_name' => '',
                    'err_value' => '',
                    'err_code' => '',
                    'err_cat' => '',
                    'read_c' => $this->Cat->read_c()
                ];

                if (in_array("", $formulario)) :

                    if (empty($formulario['name'])) :
                        $dados['err_name'] = "Os campos não podem estar vazios";
                    endif;

                    if (empty($formulario['value'])) :
                        $dados['err_value'] = "Os campos não podem estar vazios";
                    endif;
                    if (empty($formulario['code'])) :
                        $dados['err_code'] = "Os campos não podem estar vazios";
                    endif;
                    if (empty($formulario['cat'])) :
                        $dados['err_code'] = "Os campos não podem estar vazios";
                    endif;


                else :

                    if (Valida::length_nome($formulario['name'])) :
                        $dados['err_name'] = "máximo 100 dígitos";
                    else :
                        if (isset($_FILES['upload'])) :
                            $upload = new Uploads();
                            $categoria = $this->Cat->read1_c($dados['cat']);
                            $upload->imagem($_FILES['upload'], 7, 'Produtos' . DIRECTORY_SEPARATOR . $categoria['nome']);

                            if ($upload->geterro() or $upload->getexito()) :
                                Sessao::sms('upload', $upload->geterro(), 'alert alert-danger');
                                Sessao::sms('upload', $upload->getexito() . ' movida com sucesso');
                            endif;
                        endif;


                        $actualiza = $this->Data->update_p($dados, $id);

                        if ($actualiza) :

                            Sessao::izitoast('produto', 'Success','Produto actualizado com sucessso');


                            Url::redireciona('admin/produto');
                            exit;

                        else :
                            Sessao::sms('upload', 'Erro com banco de dados', 'alert alert-danger');


                        endif;

                    endif;


                endif;

            else :
                $dados = [
                    'name' => '',
                    'value' => '',
                    'code' => '',
                    'cat' => $this->Cat->read_c(),
                    'err_name' => '',
                    'err_value' => '',
                    'err_code' => '',
                    'err_cat' => '',
                    'read_c' => $this->Cat->read_c()
                ];
            endif;

        else :
            Sessao::sms('upload', 'String passado na url. Passe um numero(int)', 'alert alert-danger');
            Url::redireciona('admin/produto');
            exit;
        endif;

        $file = 'produto' . DIRECTORY_SEPARATOR . 'editar_produto';
        return $this->view('layouts/admin/app', compact('file', 'dados', 'edit'));
    }
    public function delete($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);

        if ($id and $metodo == 'POST') :
            $delete = $this->Data->delete_p($id);
            if ($delete) :
                Sessao::izitoast('produto', 'Success','Delectado');
                Url::redireciona('admin/produto');
            else :
                Sessao::izitoast('produto', 'Erro', 'Não delectado, consulte BD','error');
            endif;
        else :
            Sessao::sms('upload', 'Metodo de envio \'GET\' não é permitido', 'alert alert-danger');
            Url::redireciona('admin/produto');
        endif;
    }
}
