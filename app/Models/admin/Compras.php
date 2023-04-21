<?php
namespace App\Models\admin;

use App\Libraries\Conexao;

class Compras  
 {

   private $db;
    public function __construct()
    {
       $this->db = new Conexao();
    }

    public function list(){
        $this->db->query("SELECT * FROM fornecedor ORDER BY id DESC");
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()):
            return $this->db->resultados();
        else:
            return false;
        endif;
    }
    
    public function store1($path, $total){
      
        $this->db->query("INSERT INTO faturas_compras(path, total) VALUES(:path, :total)");
        
        $this->db->bind(':path', $path);
        $this->db->bind(':total', $total);
  
        if ($this->db->executa() AND $this->db->total()) {
            return true;
        }
        else{ 
            return false;
        }
    }
    public function store2($data, $forn){
$idfactura=$this->db->ultimoid();
      foreach($data['qtd'] as $key=>$value){
     
      
        $this->db->query("INSERT INTO compra(nome, preco, qtd, total, fatura, fornecedor, usuario) VALUES(:nome, :preco, :qtd, :total, :fatura, :fornecedor, :usuario)");
        
        $this->db->bind(':nome', $data['nome'][$key]);
        $this->db->bind(':preco', $data['preco'][$key]);
        $this->db->bind(':qtd', $data['qtd'][$key]);
        $this->db->bind(':total', ($data['qtd'][$key]*$data['preco'][$key]));
        $this->db->bind(':fatura', $idfactura);
        $this->db->bind(':fornecedor', $forn);
        $this->db->bind(':usuario', $_SESSION['usuarios_id']);
        $this->db->executa();
      }

        if ( $this->db->total()) {
            return true;
        }
        else{ 
            return false;
        }
    }

    public function get($id)
    {
        $this->db->query("SELECT * FROM  fornecedor WHERE id = :id");
        $this->db->bind(":id",$id);
        if ($this->db->executa() AND $this->db->total()): 
            $resultado=$this->db->resultado();
            return $resultado;

        else :
            return false;
        
        endif; 
    }
    public function delete(int $id)
    {
      $this->db->query('DELETE FROM fornecedor WHERE id=:id');
      $this->db->bind(':id',$id);
      if($this->db->executa() AND $this->db->total()):
          return true;
      else:
          return false;
      endif;
    }

    
   
 }