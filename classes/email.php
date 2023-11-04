<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;   
        $this->nombre = $nombre; 
        $this->token = $token;  
    }

    public function enviarConfirmacion() {
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'Appsalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        //set html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong> Has creado tu cuenta en appSalon,
        solo debes confirmarla presionando en el siguiente enlace </p>";
        $contenido .= "<p>Presiona aqui: <a href ='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token="
        . $this->token . "'>Confirmar cuenta</a> </p>";
        $contenido .= "<p> Si no solicitaste esta cuenta desestima el email. </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar email
        $mail->send();
    }

    public function enviarInstrucciones() {
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'Appsalon.com');
        $mail->Subject = 'Reestablece tu password';

        //set html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong> Has solicitado reestablecer tu password,
        solo debes confirmarla presionando en el siguiente enlace </p>";
        $contenido .= "<p>Presiona aqui: <a href ='" . $_ENV['APP_URL'] . "/recuperar?token="
        . $this->token . "'>Reestablecer password</a> </p>";
        $contenido .= "<p> Si no solicitaste esta cuenta desestima el email. </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar email
        $mail->send();
    }
}