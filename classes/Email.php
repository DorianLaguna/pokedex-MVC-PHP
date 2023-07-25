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
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '0adceb5edc9311';
        $mail->Password = '8e2653f35b8821';

        $mail->setFrom('pokeapi@correo.com');
        $mail->addAddress('pokeapi@correo.com','pokeapi_mvc.com');
        $mail->Subject = 'Confirma tu cuenta';


        //set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>
        <h1>Confirm Account</h1>
        <p>Hi " . $this->nombre . '</p>
        <p>Please, click the next link to confirm your account: </p>
        <a href="http://localhost:3000/confirmar?token=' . $this->token . '"';
        $contenido .= "
        >Confirm Account</a>
        <p>If you don't request this, you can ignore the message</p>

        </html>
        ";

        $mail->Body = $contenido;

        $mail->send();
    }
}