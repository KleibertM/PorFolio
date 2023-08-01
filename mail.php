<?php
require 'vendor/autoload.php'; // Carga la biblioteca de SendGrid

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fromEmail = $_POST['correo'];
    $message = $_POST['mensaje'];

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom($fromEmail);
    $email->setSubject('Mensaje de contacto');
    $email->addTo('tucorreo@ejemplo.com'); // Cambia esto con tu dirección de correo
    $email->addContent("text/plain", $message);

    $sendgrid = new \SendGrid('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');
    try {
        $response = $sendgrid->send($email);
        if ($response->statusCode() === 202) {
            echo "¡Mensaje enviado con éxito!";
        } else {
            echo "Hubo un error al enviar el mensaje.";
        }
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje: " . $e->getMessage();
    }
}
?>
