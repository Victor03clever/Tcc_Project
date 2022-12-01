<?php
namespace App\Models\admin;

use App\Helpers\Valida;
use App\Libraries\Conexao;

class Usuarios {
   private $db;
    public function __construct()
    {
       $this->db = new Conexao();
    }
   
   

    public function checalogin($login,$senha,$nivel){
        $this->db->query("SELECT *, usuario.id as usuario_id, nivel_usuario.id as nivel_id FROM usuario inner join nivel_usuario on usuario.id = nivel_usuario.id WHERE $login=:e ");
        $this->db->bind(':e',$login,"");
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()):
            $resultado=$this->db->resultado();
        
                 if (password_verify($senha, $resultado['senha']) AND $resultado['nivel_id']==$nivel) :
                    return $resultado;
                else:
                    return false;
                endif;
                
        else:
            return false;
        endif;
    }
}