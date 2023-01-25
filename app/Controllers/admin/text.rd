if(!Valida::regex($formulario['nome'])):
                    $dados['erro_nome'] ="Nome não válido";
                endif;
                $re = '/(.+)+(\s.+)?$/';


                Sessao::sms('login','Login realizado com sucesso');
                Sessao::notify('teste','bemvindo',null,'top left',"('#form')");
                        Sessao::izitoast('teste','deu certo','success');
