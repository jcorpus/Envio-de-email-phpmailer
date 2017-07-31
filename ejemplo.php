<?php

/*Lo primero es añadir al script la clase phpmailer desde la ubicación en que esté*/
//require '../phpmailer/class.phpmailer.php';
//require '../phpmailer/class.smtp.php';
require 'phpmailer/PHPMailerAutoload.php';
//Crear una instancia de PHPMailer
$mail = new PHPMailer();
$mail->CharSet = "UTF-8";
$mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
//Definir que vamos a usar SMTP
$mail->IsSMTP();
//Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
// 0 = off (producción)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug  = 0;
//Ahora definimos gmail como servidor que aloja nuestro SMTP
$mail->Host       = 'smtp.gmail.com';
//El puerto será el 587 ya que usamos encriptación TLS
$mail->Port       = 465;
//Definmos la seguridad como TLS
$mail->SMTPSecure = 'ssl';
//Tenemos que usar gmail autenticados, así que esto a TRUE
$mail->SMTPAuth   = true;
//Definimos la cuenta que vamos a usar. Dirección completa de la misma
$mail->Username   = "de_donde_envio@gmail.com";
//Introducimos nuestra contraseña de gmail
$mail->Password   = "contraseña";
//Definimos el remitente (dirección y, opcionalmente, nombre)
$mail->SetFrom('de_donde_envio@gmail.com', 'CABECERA - contraseña olvidada');
//Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
$mail->AddAddress('aquien_voy_a_enviar@gmail.com', 'El Destinatario');
//Definimos el tema del email
$mail->Subject = 'Recuperar Contraseña';
//Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
$mail->MsgHTML(file_get_contents('contents.html'));
//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
$mail->AltBody = 'Al parecer olvidaste tu contraseña por aca';
//Enviamos el correo
if(!$mail->Send()) {
  echo "Error: " . $mail->ErrorInfo;
} else {
  echo "Mensaje Enviado correctamene, revisa tu correo!";
}

 ?>
