<?php
namespace App\Controllers\admin;

use App\Libraries\Controller;
use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Helpers\Valida;

class Categoria extends Controller
{
    private $data;
    public function __construct()
    {
        if (Sessao::nivel1()) :
            session_destroy();
            Url::redireciona('home');
        endif;
        $this->data = $this->model("admin\Categoria");
    }

    public function index()
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        echo "Listar categorias";
    }

    public function cadastrar()
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        $formulario=filter_input_array(INPUT_POST,FILTER_DEFAULT);
        var_dump($formulario);

        if (isset($formulario['btn_save'])) :
            $dados = [
                'nome' => trim($formulario['nome']),
                'status' => trim($formulario['nome']),
                'descricao' => trim($formulario['senha']),
                'erro_nome'=>'',
                'erro_status'=>'',
                'erro_descricao'=>''
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['nome'])) :
                    $dados['erro_nome'] = "Digite o nome";
                endif;

                if (empty($formulario['descricao'])) :
                    $dados['erro_descricao'] = "preencha a descrição";
                endif;
            else :
                    if ($this->Data->checa_nome($formulario['nome'])) :
                        $dados['erro_nome'] = "nome já cadastrado";
    
                    elseif (Valida::length_nome($formulario['nome'])) :
                        $dados['erro_nome'] = "máximo 100 dígitos";
                    else:

                        $cadastrar=$this->Data->store_c($dados);
                        var_dump($cadastrar);
                        if ($cadastrar) :
                            Sessao::sms('cadastrar','Categoria cadastrada com sucesso');
                            
                            Url::redireciona('admin/categoria');
                            
                            
                            
                        else :
                            Sessao::sms('cadastrar','Erro com banco de dados','alert alert-danger');
                            
                        endif;
                   endif;    
                
                        
               

            endif;
        
        else :
            $dados = [
                'nome' => '',
                'senha' => '',
                'erro_nome'=>'',
                'erro_senha'=>''
            ];
        endif;


        $file="cadastrar_categoria";
        return $this->view('layouts/admin/app',compact('file'));
    }
}