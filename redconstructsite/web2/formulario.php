<?php

$mail = '"RedConstruct"';
$nombre = utf8_decode($_POST['name']);
$telefono = $_POST['phone'];
$correo = $_POST['emailing'];
$mensajeC = utf8_decode($_POST['messaging']);
$fecha = date('Y-m-d H:i');


// checking connection

if(mysqli_connect_errno()){
    printf("connect failed: %s\n", mysql_connect_error());
}
else{
    //$mysqli = new mysqli('localhost', 'root','', 'ecustic');
    $mysqli = new mysqli('107.180.44.153', 'webmasterplay','Play247redes', 'redconstruct');
    echo "Éxito: Se realizó una conexión apropiada a MySQL!" . PHP_EOL;

    $query = "INSERT INTO pruebas VALUES ('".$nombre."', '".$telefono."', '".$correo."', '".$mensajeC."','".$fecha."')";
    printf(mysqli_query($mysqli, $query));
    


    // sending an email

    $para = 'webmaster@play247.tv, f.restrepo@redconstruct.net';
    $asunto = 'Contacto RedConstruct';
    $mensaje = '<br><br> 
                    Este mensaje fue enviado por: 
                    Nombre: ' . $nombre . '
                    <br> Su telefono es: ' . $telefono . '
                    <br> Su Correo es:  ' . $correo . '
                    <br> El mensaje es  ' . $mensajeC . '';
    
    $header  = 'MIME-Version: 1.0' . "\r\n";
    $header .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $header .= 'From: '.$correo.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $mensaje .= "Enviado el " . date('d/m/Y', time());
    mail($para, $asunto, utf8_decode($mensaje), $header);
    require_once ('redireccion.html');
    exit;
}
mysqli_close($mysqli);

?>