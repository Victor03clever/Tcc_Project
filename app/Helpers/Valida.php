<?php
namespace App\Helpers;
class Valida{

        public static function email($email){
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)):
                return true;
            else:
                return false;
            endif;
        }
        public static function samepass($senha, $c_senha){
            if ($senha != $c_senha) {
                return true;                
            }else {
                return false;
            }
        }
        public static function length_senha($senha){
            if(strlen($senha) < 8){
                return true;
            }
            else{
                return false;
            }
        }
        public static function length_nome($nome){
            if(strlen($nome) >= 100){
                return true;
            }
            else{
                return false;
            }
        }
        public static function length($var){
            if(strlen($var) <= 255){
                return true;
            }
            else{
                return false;
            }
        }
        public static function pass_segura($senha){
            return password_hash($senha,PASSWORD_DEFAULT);
        }
        public static function ANG($dado){
            return date('d/m/Y H:i:s' , strtotime($dado));
        }
        public static function idade($dado){
            $nasc=explode('-',$dado);
            return date('Y') - $nasc[0];
        }
      
}