<?php


namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Helpers\Valida;
use App\Libraries\Controller;
// phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Password extends Controller
{
  private $credential;
  private $email;
  public function __construct()
  {
    $this->credential = $this->model("password\Password");
    $this->email = new PHPMailer(true);
  }
  public function index()
  {
    Url::redireciona("password/forget");
  }
  public function forget()
  {
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($form['btn'])) {
      $data = ['info' => trim($form['info']), 'error' => ''];
      if (in_array("", $form)) {
        if (empty($form['info'])) {
          $data['error'] = "Campo obrigatorio*";
          Sessao::sms('password', $data['error'], 'alert alert-danger');
        }
      } else {
        if (filter_var($data['info'], FILTER_VALIDATE_EMAIL)) {

          $userEmail = $this->credential->getUserEmail($data['info']);
          if ($userEmail) {
            // var_dump($userEmail);
            $recover_key = random_int(100000, 999999);
            $storeEmailKey = $this->credential->storeEmailKey($recover_key, $userEmail['email']);
            if ($storeEmailKey == true) {
              $this->sendEmail($recover_key, $userEmail);
            } else {
              Sessao::sms('password', 'Chave de recuperação não guardada', 'alert alert-danger');
            }
          } else {
            Sessao::sms('password', 'Usuario não existente no sistema', 'alert alert-danger');
          }
        } elseif (is_numeric($data['info'])) {
          $usernumber = $this->credential->getUserNumber($data['info']);
          if ($usernumber) {
            // var_dump($usernumber);

            $recover_key = random_int(100000, 999999);
            $store = $this->credential->storeKeyNumber($recover_key, $usernumber['numero']);
            if ($store == true) {
              $this->sendMessagePhone($recover_key, $usernumber['numero']);
            } else {
              Sessao::sms('password', 'Chave de recuperação não guardada', 'alert alert-danger');
            }
          } else {
            Sessao::sms('password', 'Usuario não existente no sistema', 'alert alert-danger');
          }
        } else {
          $data['error'] = "Insira email ou número cadastrado no sistema";
          Sessao::sms('password', $data['error'], 'alert alert-danger');
        }
      }
    } else {
      $data = ['info' => '', 'error' => ''];
    }
    $file = "password/forget";
    $this->view($file, $data);
  }
  public function verify($cred)
  {
    if (filter_var($cred, FILTER_VALIDATE_EMAIL)) {
      $email = $cred;
      $form = filter_input_array(INPUT_GET, FILTER_DEFAULT);
      // var_dump($form);
      if (isset($form['verify'])) {
        $data = ['key' => trim($form['key']), 'email' => $email, 'error' => ''];
        if (in_array("", $form)) {
          if (empty($form['key'])) {
            $data['error'] = "Campo obrigatorio*";
            Sessao::sms("password", "Campo obrigatorio", "alert alert-danger");
          }
        } else {
          $check = $this->credential->checkEmailKey($data);
          if ($check) {
            // var_dump($check);
            Url::redireciona("password/new/" . $data['email']);
            Sessao::sms("password", "Chave validada");
            exit;
          } else {
            Sessao::sms("password","Código Inválido","alert alert-danger");
          }
        }
      } else {
        $data = ['key' => '', 'email' => '', 'error' => ''];
      }
    } elseif (is_numeric($cred)) {
      echo "Aguarde o serviço retomar";
    } else {
      Sessao::sms("password", "Código inválido", "alert alert-danger");
    }

    $file = "password/verification";
    $this->view($file, compact('cred', 'data'));
  }
  public function new($cred)
  {
    if (filter_var($cred, FILTER_VALIDATE_EMAIL)) {
      $email=$cred;
      $form=filter_input_array(INPUT_POST,FILTER_DEFAULT);
      if(isset($form['btn'])){
        $data=['newpass'=>trim($form['newpass']),'email'=>$email,'error'=>''];
        if(in_array("",$form)){
          if(empty($form['newpass'])){
            $data['error']="Campo obrigatorio.";
            Sessao::sms("password", "Campo obrigatorio", "alert alert-danger");
          }
        }else{
          $data['newpass']= Valida::pass_segura($data['newpass']);
          $newpass=$this->credential->newEmailPass($data);
          if($newpass){
            Url::redireciona("client/login");
            Sessao::izitoast("loginE", "Success", "Senha actualizada com sucesso");
            exit;
          }else{
            Sessao::sms("password", "Senha não actualizada, tente novamente", "alert alert-danger");
          }
        }
      }else{
        $data=['newpass'=>'','email'=>'','error'=>''];

      }

    }elseif(is_numeric($cred)){
      echo "Aguarde o serviço retomar";
    }else{
      Sessao::sms("password", "Código inválido", "alert alert-danger");
    }

    $file = "password/newPass";
    $this->view($file,compact('cred','data'));
  }


  private function sendMessagePhone($key, $number)
  {
    echo URL . "/password/verify?number=" . $number . "?key=" . $key;
    // Url::redireciona("password/verify?number=" . $number . "?key=" . $key);
  }
  private function sendEmail($key, $user)
  {

    try {
      //Server settings
      // $this->email->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $this->email->CharSet = "UTF-8";
      $this->email->isSMTP();                                            //Send using SMTP
      $this->email->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
      $this->email->SMTPAuth   = true;                                   //Enable SMTP authentication
      $this->email->Username   = 'vectorclever00@gmail.com';                     //SMTP username
      $this->email->Password   = 'lyboetypjexhglqe';                               //SMTP password
      $this->email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $this->email->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $this->email->setFrom('vectorclever00@gmail.com', "Refeitorio System");
      $this->email->addAddress($user['email'], $user['nome']);     //Add a recipient



      //Content
      $this->email->isHTML(true);                                  //Set email format to HTML
      $this->email->Subject = "Recuperação de senha";
      $this->email->Body    = "Usuário: <strong>" . $user['nome'] . "</strong> <br>Solicitou a recuperação de senha<br> Para recuperação de sua senha deve usar o seguinte codigo para verificação da sua conta<br><h1>" . $key . "</h1>";
      $this->email->AltBody = "This is the body in plain text for non-HTML mail clients";

      $this->email->send();
      Url::redireciona("password/verify/" . $user['email'] . "?email=" . $user['email']);
      Sessao::sms('password', 'Mensagem enviada');
      exit;
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$this->email->ErrorInfo}";
    }
  }
}
