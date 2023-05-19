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
// twilio for sms
use Twilio\Rest\Client;

class Password extends Controller
{
  private $credential;
  private $email;
  private $account_sid;
  private $auth_token;
  private $twilio_number;
  private $client;
  public function __construct()
  {
    $this->credential = $this->model("password\Password");
    // phpmailer
    $this->email = new PHPMailer(true);
    // twilio sms
    $this->account_sid = getenv('TWILIO_ACCOUNT_SID');
    $this->auth_token = getenv('TWILIO_AUTH_TOKEN');
    $this->twilio_number = getenv('TWILIO_NUMBER');
    $this->client = new Client($this->account_sid, $this->auth_token);

    if (Sessao::nivel0() || Sessao::nivel1() || Sessao::nivel2()) {
      session_destroy();
      Url::redireciona("client/login");
    }
  }
  public function index()
  {
    if (Sessao::nivel0() || Sessao::nivel1() || Sessao::nivel2()) {
      session_destroy();
      Url::redireciona("client/login");
    } else {
      Url::redireciona("password/forget");
    }
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
  public function verify($cred = null)
  {
    if ($cred != null) {
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
              Url::redireciona("password/new/" . $data['email'] . "?key=" . $data['key']);
              Sessao::sms("password", "Chave validada");
              exit;
            } else {
              Sessao::sms("password", "Código Inválido", "alert alert-danger");
            }
          }
        } else {
          $data = ['key' => '', 'email' => '', 'error' => ''];
        }
      } elseif (is_numeric($cred)) {
        $number = $cred;
        $form = filter_input_array(INPUT_GET, FILTER_DEFAULT);
        // var_dump($form);
        if (isset($form['verify'])) {
          $data = ['key' => trim($form['key']), 'number' => $number, 'error' => ''];
          if (in_array("", $form)) {
            if (empty($form['key'])) {
              $data['error'] = "Campo obrigatorio*";
              Sessao::sms("password", "Campo obrigatorio", "alert alert-danger");
            }
          } else {
            $check = $this->credential->checkNumberKey($data);
            if ($check) {
              // var_dump($check);
              Url::redireciona("password/new/" . $data['number'] . "?key=" . $data['key']);
              Sessao::sms("password", "Chave validada");
              exit;
            } else {
              Sessao::sms("password", "Código Inválido", "alert alert-danger");
            }
          }
        } else {
          $data = ['key' => '', 'email' => '', 'error' => ''];
        }
      } else {
        Sessao::sms("password", "Código inválido", "alert alert-danger");
      }
    } else {
      Url::redireciona("password");
      Sessao::sms("password", "Acesso inválido", "alert alert-danger");
      exit;
    }

    $file = "password/verification";
    $this->view($file, compact('cred', 'data'));
  }
  public function new($cred = null)
  {
    $form = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    $key = $form['key'];
    if ($cred != null) {
      if (filter_var($cred, FILTER_VALIDATE_EMAIL)) {
        $array = ['key' => $key, 'email' => $cred];
        $checkKey = $this->credential->checkEmailKey($array);
        if ($checkKey) {
          $email = $cred;
          if (isset($form['btn'])) {
            $data = ['newpass' => trim($form['newpass']), 'email' => $email, 'error' => ''];
            if (in_array("", $form)) {
              if (empty($form['newpass'])) {
                $data['error'] = "Campo obrigatorio.";
                Sessao::sms("password", "Campo obrigatorio", "alert alert-danger");
              }
            } else {
              $data['newpass'] = Valida::pass_segura($data['newpass']);
              $newpass = $this->credential->newEmailPass($data);
              if ($newpass) {
                Url::redireciona("client/login");
                Sessao::izitoast("loginE", "Success", "Senha actualizada com sucesso");
                exit;
              } else {
                Sessao::sms("password", "Senha não actualizada, tente novamente", "alert alert-danger");
              }
            }
          } else {
            $data = ['newpass' => '', 'email' => '', 'error' => ''];
          }
        } else {
          Url::redireciona("password");
          Sessao::sms("password", "Acesso inválido", "alert alert-danger");
          exit;
        }
      } elseif (is_numeric($cred)) {
        $array = ['key' => $key, 'number' => $cred];
        $checkKey = $this->credential->checkNumberKey($array);
        if ($checkKey) {

          $number = $cred;
          if (isset($form['btn'])) {
            $data = ['newpass' => trim($form['newpass']), 'number' => $number, 'error' => ''];
            if (in_array("", $form)) {
              if (empty($form['newpass'])) {
                $data['error'] = "Campo obrigatorio.";
                Sessao::sms("password", "Campo obrigatorio", "alert alert-danger");
              }
            } else {
              $data['newpass'] = Valida::pass_segura($data['newpass']);
              $newpass = $this->credential->newNumberPass($data);
              if ($newpass) {

                Url::redireciona("client/login");
                Sessao::izitoast("loginE", "Success", "Senha actualizada com sucesso");
                exit;
              } else {
                Sessao::sms("password", "Senha não actualizada, tente novamente", "alert alert-danger");
              }
            }
          } else {
            $data = ['newpass' => '', 'number' => '', 'error' => ''];
          }
        } else {
          Url::redireciona("password");
          Sessao::sms("password", "Acesso inválido", "alert alert-danger");
          exit;
        }
      } else {
        Sessao::sms("password", "Código inválido", "alert alert-danger");
      }
    } else {
      Url::redireciona("password");
      Sessao::sms("password", "Acesso inválido", "alert alert-danger");
      exit;
    }

    $file = "password/newPass";
    $this->view($file, compact('cred', 'key', 'data'));
  }


  private function sendMessagePhone($key, $number)
  {
    $number="+244".str_replace("+244","",$number);
    try {
      $this->client->messages->create(
        // Where to send a text message (your cell phone?)
        $number,
        array(
          'from' => $this->twilio_number,
          'body' => 'Este é o seu código de recuperação de senha: '.$key
        )
      );
      // echo URL . "/password/verify?number=" . $number . "?key=" . $key;
      Url::redireciona("password/verify/" . $number . "?numero=" . $number);
      Sessao::sms('password', 'Mensagem enviada');
      exit;
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
    }
    

  }
  private function sendEmail($key, $user)
  {

    try {
      //Server settings
      // $this->email->SMTPDebug = SMTP::DEBUG_SERVER;                      
      $this->email->CharSet = "UTF-8";
      $this->email->isSMTP();
      $this->email->Host       = getenv('MAIL_HOST');
      $this->email->SMTPAuth   = true;
      $this->email->Username   = getenv('MAIL_USERNAME');
      $this->email->Password   = getenv('MAIL_PASSWORD');
      $this->email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $this->email->Port       = getenv('MAIL_PORT');

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
