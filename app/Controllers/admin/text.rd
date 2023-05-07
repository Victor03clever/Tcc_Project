if(!Valida::regex($formulario['nome'])):
                    $dados['erro_nome'] ="Nome não válido";
                endif;
                $re = '/(.+)+(\s.+)?$/';


                Sessao::sms('login','Login realizado com sucesso');
                Sessao::notify('teste','bemvindo',null,'top left',"('#form')");
                        Sessao::izitoast('teste','deu certo','success');
<h1>Oi tudo bem, como vai lindona, vou bem obrigada, vi vc passar e decidi vir falar com vc, qual o seu nome, prazer em conhecer vc, nunca vi vc poor aqui, eu acho que lembraria de vc es muito bonita, onde vc mora, vieste dar um passeio, estas a chegar aonde, posso te acompanhar, deves achar estranho ne assim do nada, e que eu gosto de conhecer pessoas ainda mais bonita, quem sabe se calhar es o amor da minha vida, a verdade e que desde que acordei ainda nao vi alguem mais linda que vc</h1>