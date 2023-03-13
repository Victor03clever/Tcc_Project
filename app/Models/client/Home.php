<?php

namespace App\Models\client;

use App\Libraries\Conexao;

class Home
{

    private $db;
    public function __construct()
    {
        $this->db = new Conexao();
    }
    public function getfood()
    {
        $this->db->query("SELECT * FROM refeicoes WHERE status = :status");
        $this->db->bind(":status", "1");
        $this->db->executa();
        if ($this->db->executa() and $this->db->total()) {
            $result = $this->db->resultados();
            return $result;
        } else {
            return false;
        }
    }
    public function getFoodByOne($id)
    {
        $this->db->query("SELECT * FROM refeicoes WHERE id = :id");
        $this->db->bind(":id", $id);
        $this->db->executa();
        if ($this->db->executa() and $this->db->total()) {
            $result = $this->db->resultado();
            return $result;
        } else {
            return false;
        }
    }
    // pedidos para refeicoes
    public function makeRequestR($dados, $qtd)
    {
        $this->db->query("INSERT INTO pedido (refeicoes, escola, status, qtd, preco) VALUES(:id,:userId, :status, :qtd, :preco)");
        $this->db->bind(":id", $dados['id']);
        $this->db->bind(":userId", $_SESSION['usuarioC_id']);
        $this->db->bind(":status", "0");
        $this->db->bind(":qtd", $qtd);
        $this->db->bind(":preco", $dados['preco']);
        if ($this->db->executa() and $this->db->total()) {
            return true;
        } else {
            return false;
        }
    }
}
