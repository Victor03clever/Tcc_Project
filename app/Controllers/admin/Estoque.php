<?php

namespace App\Controllers\admin;

use App\Helpers\Sessao;
use App\Helpers\Valida;
use App\Helpers\Url;
use App\Libraries\uploads;
use App\Libraries\Controller;

class Estoque extends Controller
{
    private $Data;
    public function __construct()
    {
        if (Sessao::nivel1()) :
            session_destroy();
            Url::redireciona('home');
        endif;
        $this->Data = $this->model("admin\Estoque");
    }
    public function index(){
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;

        $dados = $this->Data->read_estoque();
       
        $file = 'estoque'.DIRECTORY_SEPARATOR.'estoque';
        return $this->view('layouts/admin/app', compact('file', 'dados'));
    }
    public function create(){
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;

        $produto = $this->Data->read_p();
       
        $formulario=filter_input_array(INPUT_POST,FILTER_DEFAULT);
        if(isset($formulario['store'])){
            $dados=[
                'lote'=>trim($formulario['lote']),
                'fab'=>trim($formulario['fab']),
                'exp'=>trim($formulario['exp']),
                'qtd'=>trim($formulario['qtd']),
                'produto'=>trim($formulario['produto']),
                'usuario'=>$_SESSION['usuarios_id'],
                'err_pro'=>'',
                'err_lote'=>'',
                'err_fab'=>'',
                'err_exp'=>'',
                'err_qtd'=>''
            ];
            if(in_array("",$formulario))
            {
                if(empty($formulario['lote'])){
                    $dados['err_lote']="Informe o lote do produto";
                }
                if(empty($formulario['fab'])){
                    $dados['err_fab']="Informe a data de fabricação do produto";
                }
                if(empty($formulario['exp'])){
                    $dados['err_exp']="Informe a data de expiração do produto";
                }
                if(empty($formulario['qtd'])){
                    $dados['err_qtd']="Informe a quantidade proposta do produto";
                }
                if(empty($formulario['produto'])){
                    $dados['err_pro']="Diga qual produto para entrada de estoque";
                }
                Sessao::izitoast('est', 'Warning','Algo deu errado tente novamente','error');
                
            }
            
            else{
                if ($this->Data->checa_lote($formulario['lote'])) {
                    $dados['err_lote'] = "Lote já cadastrado";
                }
                else{
                     $entrada = $this->Data->entrada_estoque($dados);
                     if($entrada){
                        Sessao::izitoast('est', 'Success','Entrada de estoque feito com sucesso');
                        Url::redireciona('admin/estoque');
                        exit;
                      
                     }else{
                        Sessao::izitoast('est','Error','Erro com Banco de Dados','error');
                     }
                }
            }
            
        }else{
            $dados=[
                'lote'=>'',
                'fab'=>'',
                'exp'=>'',
                'qtd'=>'',
                'produto'=>'',
                'err_pro'=>'',
                'err_lote'=>'',
                'err_fab'=>'',
                'err_exp'=>'',
                'err_qtd'=>''
            ];
        }

        $file = 'estoque'.DIRECTORY_SEPARATOR.'entrada_estoque';
        return $this->view('layouts/admin/app', compact('file', 'dados','produto'));
    }

    public function edite($id)
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id):
            
            $produto = $this->Data->read_p();
            $estoque = $this->Data->read_estoque1($id);
            
            $formulario=filter_input_array(INPUT_POST,FILTER_DEFAULT);
            if(isset($formulario['store'])){
                $dados=[
                    'lote'=>trim($formulario['lote']),
                    'fab'=>trim($formulario['fab']),
                    'exp'=>trim($formulario['exp']),
                    'qtd'=>trim($formulario['qtd']),
                    'produto'=>trim($formulario['produto']),
                    'usuario'=>$_SESSION['usuarios_id'],
                    'err_pro'=>'',
                    'err_lote'=>'',
                    'err_fab'=>'',
                    'err_exp'=>'',
                    'err_qtd'=>''
                ];
                
                if(in_array("",$formulario))
                {
                    if(empty($formulario['lote'])){
                        $dados['err_lote']="Informe o lote do produto";
                    }
                    if(empty($formulario['fab'])){
                        $dados['err_fab']="Informe a data de fabricação do produto";
                    }
                    if(empty($formulario['exp'])){
                        $dados['err_exp']="Informe a data de expiração do produto";
                    }
                    if(empty($formulario['qtd'])){
                        $dados['err_qtd']="Informe a quantidade proposta do produto";
                    }
                    // if(empty($formulario['produto'])){
                    //     $dados['err_pro']="Diga qual produto para entrada de estoque";
                    // }
                    Sessao::izitoast('est', 'Warning','Algo deu errado tente novamente','error');
                    
                }
                
                else{
                    
                         $actualiza = $this->Data->update_estoque($dados, $id);
                         if($actualiza){
                            Sessao::izitoast('est', 'Success','Actualização de estoque feita com sucesso');
                            Url::redireciona('admin/estoque');
                            exit;
                          
                         }else{
                            Sessao::izitoast('est','Error','Não actualizou, escreva algo diferente','error');
                         }
                    
                }
                
            }else{
                $dados=[
                    'lote'=>$estoque['l_lote'],
                    'fab'=>$estoque['data_prod'],
                    'exp'=>$estoque['data_exp'],
                    'qtd'=>$estoque['qtd'],
                    'produto'=>$estoque['e_produto'],
                    'err_pro'=>'',
                    'err_lote'=>'',
                    'err_fab'=>'',
                    'err_exp'=>'',
                    'err_qtd'=>''
                ];
            }
        else :
            Sessao::sms('erro', 'String passado na url. Passe um (int)', 'alert alert-danger');
            Url::redireciona("admin/estoque");
            exit;
            
        endif;
        $file = 'estoque'.DIRECTORY_SEPARATOR.'editar_estoque';
        return $this->view('layouts/admin/app', compact('file', 'dados', 'produto','estoque'));
    
    }
    public function delete($id){
        {
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
    
            if ($id and $metodo == 'POST') :
                // $delete = $this->Data->delete_estoque($id);
                if ($this->Data->delete_estoque($id)) :
                    Sessao::izitoast('est', 'Success', 'Delectado com sucesso');
                    Url::redireciona('admin/estoque');
                    exit;
                else :
                    Sessao::izitoast('est', 'Erro', 'Não delectado, consulte BD','error');
                endif;
            else :
                Sessao::sms('erro', 'Metodo de envio \'GET\' não é permitido', 'alert alert-danger');
                Url::redireciona('admin/estoque');
            endif;
        }
    }
}