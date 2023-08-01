<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $nombre;
    public $correo;
    public $token;
    
    public function __construct($nombre, $correo, $token)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->token = $token;
    }
    
    public function enviarConfirmacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('pokeapi@correo.com');
        $mail->addAddress('pokeapi@correo.com','pokeapi_mvc.com');
        $mail->Subject = 'Confirm youy account';


        //set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>
        <h1>Confirm Account</h1>
        <p>Hi " . $this->nombre . '</p>
        <p>Please, click the next link to confirm your account: </p>
        <a href="' . $_ENV['APP_URL'] . '/confirmar?token=' . $this->token . '"';
        $contenido .= "
        >Confirm Account</a>
        <p>If you don't request this, you can ignore the message</p>

        </html>
        ";

        $mail->Body = $contenido;

        $mail->send();
    }

    public function cambiarPassword(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('pokeapi@correo.com');
        $mail->addAddress('pokeapi@correo.com','pokeapi_mvc.com');
        $mail->Subject = 'Change your password';


        //set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>
        <h1>Change Password</h1>
        <p>Hi " . $this->nombre . '</p>
        <p>Please, click the next link to change your password: </p>
        <a href="' . $_ENV['APP_URL'] . '/change?token=' . $this->token . '"';
        $contenido .= "
        >Change password</a>
        <p>If you don't request this, you can ignore the message</p>

        </html>
        ";

        $mail->Body = $contenido;

        $mail->send();
    }
}