<?php
namespace App\Models\admin;

use App\Libraries\Conexao;

class Categoria
 {

   private $db;
    public function __construct()
    {
       $this->db = new Conexao();
    }

    public function checa_nome(string $nome){
        $this->db->query("SELECT nome FROM categoria WHERE nome=:nome");
        $this->db->bind(':nome',$nome);
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()):
            return true;
        else:
            return false;
        endif;
    }
    
    public function store_c(Array $data){
        $this->db->query("INSERT INTO categoria(nome, descricao, status) VALUES(:nome, :descricao, :status)");
        
        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':descricao', $data['descricao']);
        $this->db->bind(':status', $data['status']);


        if ($this->db->executa() AND $this->db->total()) {
            return true;
        }
        else{ 
            return false;
        }
    }

    public function read_c()
    {
        $this->db->query("SELECT * FROM  categoria");

        if ($this->db->executa() AND $this->db->total()): 
            $resultado=$this->db->resultados();
            return $resultado;

        else :
            return false;
        
        endif; 
    }
 }