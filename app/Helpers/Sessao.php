<?php

namespace App\Helpers;

class Sessao
{
    # com bootstrap
    public static function sms($nome, $texto=null, $classe=null){
        if(!empty($nome)):
            if(!empty($texto) AND empty($_SESSION[$nome])):
                if(!empty($_SESSION[$nome])):
                    unset($_SESSION[$nome]);
                endif;
                $_SESSION[$nome]=$texto;
                $_SESSION[$nome.'classe']=$classe;
            elseif(!empty($_SESSION[$nome]) AND empty($texto)): 
                $classe= !empty($_SESSION[$nome.'classe'])?$_SESSION[$nome.'classe']:'alert alert-success';  
                echo "<div class='$classe'>".$_SESSION[$nome]."</div>";
    unset( $_SESSION[$nome]);
    unset($_SESSION[$nome.'classe']);
            endif;
        endif;
    }
    public static function izitoast($nome, $titulo=null, $texto=null, $classe=null, $position=null){
        if(!empty($nome)):
            if(!empty($texto)  AND !empty($titulo) AND empty($_SESSION[$nome])):
                if(!empty($_SESSION[$nome])):
                    unset($_SESSION[$nome]);
                endif;
                $_SESSION[$nome]=$texto;
                $_SESSION[$nome.'titulo']=$titulo;
                $_SESSION[$nome.'classe']=$classe;
                $_SESSION[$nome.'position']=$position;

            elseif(!empty($_SESSION[$nome]) AND empty($texto) AND empty($titulo) ): 
                $classe= !empty($_SESSION[$nome.'classe'])?empty($_SESSION[$nome.'classe']):'success';  
                $position= !empty($_SESSION[$nome.'position'])?empty($_SESSION[$nome.'position']):'topRight';  
                $titulo=!empty($_SESSION[$nome.'titulo'])?$_SESSION[$nome.'titulo']:'Nao editado';
                echo "<script>
                $(document).ready(function(){
                        iziToast.$classe({
                                 title:'$titulo',
                                 position:'$position',
                                 message:'$_SESSION[$nome]'
                             });
                    });
                    </script>";
               
                unset( $_SESSION[$nome]);
                unset($_SESSION[$nome.'titulo']);
                unset($_SESSION[$nome.'classe']);
                unset($_SESSION[$nome.'position']);
            endif;
        endif;
    }
    public static function notify($nome, $texto=null, $classe=null, $position=null){
        if(!empty($nome)):
            if(!empty($texto) AND empty($_SESSION[$nome])):
                if(!empty($_SESSION[$nome])):
                    unset($_SESSION[$nome]);
                endif;
                $_SESSION[$nome]=$texto;
                $_SESSION[$nome.'classe']=$classe;
                $_SESSION[$nome.'position']=$position;

            elseif(!empty($_SESSION[$nome]) AND empty($texto)  ): 
                $classe= !empty($_SESSION[$nome.'classe'])?empty($_SESSION[$nome.'classe']):'success';  
                $position= !empty($_SESSION[$nome.'position'])?empty($_SESSION[$nome.'position']):'top right';  
                
                echo "<script>
                $(document).ready(function(){
                             $.notify('$_SESSION[$nome]', {position: '$position', className:'$classe'});
                    });
                    </script>";
                    
               
                unset( $_SESSION[$nome]);
                unset($_SESSION[$nome.'classe']);
                unset($_SESSION[$nome.'position']);
            endif;
        endif;
    }
    // public static function mensagem($nome, $texto = null, $estilo = null)
    // {
    //     if (!empty($nome)) :
    //         if (!empty($texto) and empty($_SESSION[$nome])) :
    //             if (!empty($_SESSION[$nome])) :
    //                 unset($_SESSION[$nome]);
    //             endif;
    //             $_SESSION[$nome] = $texto;
    //             $_SESSION[$nome . 'estilo'] = $estilo;
    //         elseif (!empty($_SESSION[$nome]) and empty($texto)) :
    //             //mensagen de sucesso
    //             $sucesso = "background-color:rgba(0, 100, 0, 0.526); font-family: Verdana, Geneva, Tahoma, sans-serif; padding: 10px; margin: auto;  width: auto;";
    //             //mensagen de erro
    //             $alerta = "background-color: rgba(165, 42, 42, 0.902); font-family: Verdana, Geneva, Tahoma, sans-serif; padding: 10px; margin: auto; width: auto;";

    //             $estilo = !empty($_SESSION[$nome . 'estilo'] and $_SESSION[$nome . 'estilo'] == 'alerta') ? $alerta : $sucesso;
    //             $mensagem = "<div style='$estilo'>" . $_SESSION[$nome] . "</div>";
    //             echo $mensagem;
    //             unset($_SESSION[$nome]);
    //             unset($_SESSION[$nome . 'classe']);


    //         endif;
    //     endif;
    // }
    public static function nivel1(){
        if(isset($_SESSION['usuario_id'])):
            return true;
        else:
            return false;    
        endif;
    }
    public static function nivel0(){
        if(isset($_SESSION['usuarios_id'])):
            return true;
        else:
            return false;    
        endif;
    }
    public static function restrito1($id){
        if($id!=$_SESSION['usuario_id']):
            return true;
        else:
            return false;    
        endif;
    }
}
