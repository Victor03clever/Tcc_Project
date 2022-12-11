if(!Valida::regex($formulario['nome'])):
                    $dados['erro_nome'] ="Nome não válido";
                endif;
                $re = '/(.+)+(\s.+)?$/';
