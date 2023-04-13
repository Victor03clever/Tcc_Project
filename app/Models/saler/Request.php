<?php

namespace App\Models\saler;

use App\Libraries\Conexao;

class Request
{

  private $db;
  public function __construct()
  {
    $this->db = new Conexao();
  }

  

  public function getAllRequest(){
    $this->db->query("SELECT * FROM pedido WHERE pedido.status = :status AND pedido.escola = :iduser ");
    $this->db->bind(":status", "0");
    $this->db->bind(":iduser", $_SESSION['usuarioC_id']);
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultados();
      return $result;
    } else {
      return false;
    }
  }

  public function confirmRequest(){
      $this->db->query("UPDATE pedido SET pedido.status = :status WHERE pedido.escola = :iduser");
      $this->db->bind(":status", "1");
      $this->db->bind(":iduser", $_SESSION['usuarioC_id']);
      if($this->db->executa() AND $this->db->total()){
        return true;
      }else{
        return false;
      }
    
  }

  public function totalRequest()
  {
    $this->db->query("SELECT count(pedido.escola) as totalpedidos FROM pedido WHERE pedido.status = :status");
    $this->db->bind(":status", "1");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }



  public function deleteRequest($id)
  {
    $this->db->query("DELETE FROM pedido WHERE id=:id");
    $this->db->bind(":id", $id);
    if ($this->db->executa() and $this->db->total()) {
      return true;
    } else {
      return false;
    }
  }
}
