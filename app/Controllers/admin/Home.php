<?php
namespace App\Controllers\admin;
use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;
use DateTime;

class Home extends Controller
{
    private $Data;
    public function __construct()
    {
        if (Sessao::nivel1()) :
            session_destroy();
            Url::redireciona('home');
        endif;
        $this->Data = $this->model("admin\Home");
    }

    public function index()
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        // 2
        $recent=$this->Data->recentRequest();
        $funcionarios=$this->Data->totalUsers()['users'];
        $clients=$this->Data->totalClients()['clients'];
        $fornecedor=$this->Data->totalForn()['forne'];
        $category=$this->Data->totalCategory()['category'];
        // 1
        $sales=$this->Data->totalSales()['sales'];
        $compras=$this->Data->totalCompras()['compras'];
        $estoque=$this->Data->totalEstoque()['estoque'];
        $money=$this->Data->totalMoney()['money'];
        $moneyP=$this->Data->totalMoneyP()['pedido'];
        // 3
        $sales1=$this->Data->Sales1()['sales'];
        $sales2=$this->Data->Sales2()['sales'];
        $sales3=$this->Data->Sales3()['sales'];
        $sales4=$this->Data->Sales4()['sales'];
        $sales5=$this->Data->Sales5()['sales'];
        $sales6=$this->Data->Sales6()['sales'];
        $sales7=$this->Data->Sales7()['sales'];

        // var_dump($sales6);
        // exit;
        $file='home'; 
        return $this->view('layouts/admin/app',compact('file','recent','funcionarios','clients','fornecedor','category','sales','compras','estoque','money','moneyP','sales1','sales2','sales3','sales4','sales5','sales6','sales7'));
    }
}

