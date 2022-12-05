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
        $this->db->query("INSERT INTO usuarios(nome, email, senha, data_nascimento) VALUES(:nome, :email, :senha, :datta)");
        
        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':descricao', $data['descricao']);
        $this->db->bind(':status', $data['status']);


        if ($this->db->executa()) {
            return true;
        }
        else{ 
            return false;
        }
    }
 }