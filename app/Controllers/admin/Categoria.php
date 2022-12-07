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

    public function index($v)
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        $dados = $this->data->read_c();


var_dump($v);
        $file="listar_categoria";
        return $this->view('layouts/admin/app',compact('file', 'dados'));
        
    }

    public function create()
    {
        
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        $formulario = filter_input_array(INPUT_POST,FILTER_DEFAULT);
        
        if (isset($formulario['btn_save'])) :
            
            $dados = [
                'nome' => trim($formulario['nome']),
                'status' => trim($formulario['status']),
                'descricao' => trim($formulario['descricao']),
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
                // echo'm';
                    if ($this->data->checa_nome($formulario['nome'])) :
                        $dados['erro_nome'] = "nome já cadastrado";
                    elseif (Valida::length_nome($formulario['nome'])) :
                    $dados['erro_nome'] = "máximo 100 dígitos";
                    else :
                    
                        // echo 'ok';
                        // var_dump($formulario);
                        $cadastrar=$this->data->store_c($dados);
                        if ($cadastrar) :
                            // var_dump($cadastrar);
                            Sessao::sms('cadastrar','Categoria cadastrada com sucesso');
                            
                            // Url::redireciona('admin/categoria');
                                    
                        else :
                            Sessao::sms('cadastrar','Erro com banco de dados','alert alert-danger');
                            
                        endif;
                    endif;    
                

            endif;
        
        else :
            $dados = [
                'nome' => '',
                'descricao' => '',
                'status'=>'',
                'erro_nome'=>'',
                'erro_descricao'=>'',
                'erro_status'=>''
            ];
        endif;


        $file="cadastrar_categoria";
        return $this->view('layouts/admin/app',compact('file','dados'));
    }

    public function edite($it)
    {
        if(!Sessao::nivel0()):
            Url::redireciona('home');
        endif;
        // $id = filter_var($id,FILTER_VALIDATE_INT);
        var_dump($it);
            $file = 'editar_categoria';
            return $this->view('layouts/admin/app',compact('file'));
        

    }
}