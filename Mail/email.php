<?php

require "../PHPMailer/src/Exception.php";
require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {

    private $evaluado;
    private $evaluador;
    private $tipo;
    private $destino;
    private $imagen;
    private $encuesta;

    function __construct() {
        
    }

    function getEvaluado() {
        return $this->evaluado;
    }

    function getEvaluador() {
        return $this->evaluador;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getDestino() {
        return $this->destino;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getEncuesta() {
        return $this->encuesta;
    }

    function setEvaluado($evaluado) {
        $this->evaluado = $evaluado;
    }

    function setEvaluador($evaluador) {
        $this->evaluador = $evaluador;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setDestino($destino) {
        $this->destino = $destino;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setEncuesta($encuesta) {
        $this->encuesta = $encuesta;
    }

    function enviarMail(Mail $mail) {

        $evaluado  = $mail->getEvaluado();
        $evaluador = $mail->getEvaluador();
        $tipo      = $mail->getTipo();      
        $destino   = $mail->getDestino();
        $imagen    = $mail->getImagen(); 
        $encuesta  = $mail->getEncuesta();
                
        $mensaje;
        switch ($tipo) {
            case 1:
                include '../Mail/plantilla_mail_asignacion.php';
                break;
            case 2:
                include '../Mail/plantilla_mail_citacion.php';
                break;
        }


        $oMail = new PHPMailer();
        $oMail->isSMTP();
        $oMail->Host = "smtp.gmail.com";
        $oMail->Port = 587;
        $oMail->SMTPSecure = "tls";
        $oMail->SMTPAuth = true;
        $oMail->Username = "owl.evaluacion@gmail.com";
        $oMail->Password = "evaluacion123.";
        $oMail->setFrom("owl.evaluacion@gmail.com", "Owl Evaluation");
        $oMail->addAddress($destino, "Direccion a quien envia");
        $oMail->Subject = "Evaluacion de personal";
        $oMail->msgHTML($mensaje);

        if (!$oMail->send()) {
            echo $oMail->ErrorInfo;
        }
//para error smpt 
//https://myaccount.google.com/lesssecureapps?utm_source=google-account&utm_medium=web&pli=1
    }

}
