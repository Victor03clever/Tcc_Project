<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class  Api  extends Controller
{

  private $Request;
  public function __construct()
  {
    $this->Request = $this->model("client\Home");
  }

  public function index()
  {
    $data = $this->Request->getProducts();

    $products = [];

    foreach ($data as $key => $value) {

      $product = [
        "id" => $value['p_id'],
        "image" => $value['imagem'],
        "title" => $value['p_nome'],
        "price" => $value['preco'],
        "category_id" => $value['c_id'],
        "inCart" => 0
      ];

      array_push($products, $product);
    }

    echo json_encode($products);
  }
  public function getDishes(){
    $data = $this->Request->getFood();
    $dishes = [];

    foreach ($data as $key => $value) {

      $dish = [
        "id" => $value['id'],
        "image" => $value['imagem'],
        "title" => $value['nome'],
        "price" => $value['preco'],
        "inCart" => 0
      ];

      array_push($dishes, $dish);
    }

    echo json_encode($dishes);

  }
}
