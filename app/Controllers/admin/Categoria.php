<?php

namespace App\Controllers\admin;

use App\Helpers\Url;
use App\Helpers\Sessao;
use App\Libraries\Controller;
use App\Helpers\Valida;
use App\Libraries\Uploads;
use LDAP\Result;

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
        $dados = $this->data->read_c();

       
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($formulario['btn_save'])) :

            $dados1 = [
                'nome' => trim($formulario['nome']),
                'status' => trim($formulario['status']),
                'descricao' => trim($formulario['descricao']),
                'erro_nome' => '',
                'erro_status' => '',
                'erro_descricao' => ''
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['nome'])) :
                    $dados1['erro_nome'] = "Digite o nome";
                endif;

                if (empty($formulario['descricao'])) :
                    $dados1['erro_descricao'] = "preencha a descrição";
                endif;
                Sessao::izitoast('categoriaA','Alert','Algo deu errado, tente cadastrar novamente','warning');

            else :
              
                if ($this->data->checa_nome($formulario['nome'])) :
                    $dados1['erro_nome'] = "nome já cadastrado";
                    Sessao::izitoast('categoriaA','Alert','Algo deu errado, tente cadastrar novamente','warning');
                elseif (Valida::length_nome($formulario['nome'])) :
                    $dados1['erro_nome'] = "máximo 100 dígitos";
                    Sessao::izitoast('categoriaA','Alert','Algo deu errado, tente cadastrar novamente','warning');
                else :

                   
                    $cadastrar = $this->data->store_c($dados1);
                    
                    if ($cadastrar):
                                            
                       $sms= Sessao::izitoast('categoriaS','success','Categoria cadastrada com sucesso');
                       Url::redireciona('admin/categoria');     
                       
                       
                       // limpando as variaveis;
                       $dados1['erro_nome'] = "";
                       $dados1['nome'] = "";
                       $dados1['erro_descricao'] = "";
                       $dados1['descricao'] = "";
                       exit;
                        
                    else:
                        
                        Sessao::izitoast('categoriaE','Erro','Erro com banco de dados','error');
                        
                    endif;
                endif;


            endif;

        else :
            $dados1 = [
                'nome' => '',
                'descricao' => '',
                'status' => '',
                'erro_nome' => '',
                'erro_descricao' => '',
                'erro_status' => ''
            ];
        endif;

        $file = 'categoria'.DIRECTORY_SEPARATOR."categoria";
        return $this->view('layouts/admin/app', compact('file', 'dados','dados1'));
    }

  

    public function edit($id)
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id) :
            $edit = $this->data->edit_c($id);
            $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (isset($formulario['btn_save'])) :

                $dados = [
                    'nome' => trim($formulario['nome']),
                    'status' => trim($formulario['status']),
                    'descricao' => trim($formulario['descricao']),
                    'erro_nome' => '',
                    'erro_status' => '',
                    'erro_descricao' => ''
                ];

                if (in_array("", $formulario)) :

                    if (empty($formulario['nome'])) :
                        $dados['erro_nome'] = "Digite o nome";
                    endif;

                    if (empty($formulario['descricao'])) :
                        $dados['erro_descricao'] = "preencha a descrição";
                    endif;


                else :


                    if (Valida::length_nome($formulario['nome'])) :
                        $dados['erro_nome'] = "máximo 100 dígitos";
                    elseif (Valida::length_nome($formulario['descricao'])) :
                        $dados['erro_descricao'] = "máximo 100 dígitos";

                    else :


                        $actualiza = $this->data->update_c($dados, $id);
                        if ($actualiza) :

                            // Sessao::sms('lista', 'Categoria cadastrada com sucesso');
                            Sessao::izitoast('categoriaS','Success','Categoria actualizada com sucesso');

                            Url::redireciona('admin/categoria');
                            exit;

                        else :
                            
                            Sessao::izitoast('categoriaE','Erro','Dados não actualizados','error');


                        endif;
                    endif;


                endif;

            else :
                $dados = [
                    'nome' => '',
                    'descricao' => '',
                    'status' => '',
                    'erro_nome' => '',
                    'erro_descricao' => '',
                    'erro_status' => ''
                ];
            endif;

        else :
            Sessao::sms('metodo', 'String passado na url. Passe um (int)', 'alert alert-danger');
            
        endif;
        $file = 'categoria'.DIRECTORY_SEPARATOR.'editar_categoria';
        return $this->view('layouts/admin/app', compact('file', 'dados', 'edit'));
    }
    public function delete($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
        
        if($id AND $metodo=='POST'):
            $delete= $this->data->delete_c($id);
            if($delete):
                Sessao::izitoast('categoriaS','Success','delectada com sucesso');
                Url::redireciona('admin/categoria');
            else:
                Sessao::izitoast('categoriaE','Erro','Erro com banco de dados','error');

            endif;
        else:
            Sessao::sms('metodo','Metodo de envio \'GET\' não é permitido','alert alert-danger');
            Url::redireciona('admin/categoria');
        endif;
    }
}
