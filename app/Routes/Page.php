<?php
use  App\Http\Response;
use App\Controllers\Home;


$route->get('/{id}',[
    function($id){
        $home= new  App\Controllers\Home;
        return new Response(200, '$home->index()'.$id);
    }
]);
$route->get('/home',[
    function(){
        $home= new  App\Controllers\Home;
        return new Response(200, $home->index());
    }
]);
