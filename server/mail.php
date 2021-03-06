<?php

require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbNotificationManager.php");
require_once('validate.php');
require_once('../vendor/autoload.php');

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// function composeMail($to, $type, $arguments) {
//     switch($type) {
//         case "login":
//             checkParams(array("username"), $arguments);
//             $subject = "Hai effettuato il login ";
//             $txt = "Ciao ".$arguments["username"].", bentornato su UniboVynil https://www.unibovynil.altervista.org/index.php";
//             break;
//         case "register":
//             checkParams(array("username"), $arguments);
//             $subject = "Registrazione avvenuta";
//             //$txt = "prova";
//             //$txt = "Grazie ".$arguments["username"]." per esserti registrato a UniboVynil, il nuovo servizio di UniBo per la spedizione di cd e vinili è a tua disposizione, non perderti le nuove uscite su https://www.unibovynil.altervista.org/index.php";
//             break;
//         case "orderCreated": 
//             //checkParams(array("orderNumber", "username"), $arguments);

//             $subject = "Ordine effettuato con successo";
//             $txt = "prova";
//             //$txt = "Grazie ".$arguments["username"]." per aver effettuato l'ordine ".$arguments["orderNumber"]. ". Sarai ricontattato tramite mail quando l'ordine verrà spedito. Per maggiori informazioni https://www.unibovynil.altervista.org/index.php";
//             break;
//         case "orderSent": 
//             $subject = "Il tuo ordine è stato spedito";
//             $txt = "L'ordine ".$arguments["orderNumber"]." è stato spedito, a breve sarà disponibile presso la sede da te scelta. Per maggiori informazioni https://www.unibovynil.altervista.org/index.php";
//             break;
//         case "orderDelivered": 
//                 $subject = "Il tuo ordine è stato consegnato";
//                 $txt = "L'ordine ".$arguments["orderNumber"]." è stato consegnato in sede. Per maggiori informazioni https://www.unibovynil.altervista.org/index.php";
//                 break;
//         case "orderError": 
//             $subject = "Qualcosa è andato storto con il tuo ordine D:";
//             $txt = "Ciao ".$arguments["username"].", ci scusiamo per il disagio ma qualcosa è andato storto con la tua ordinazione, ti preghiamo di effettuarla nuovamente tramite https://www.unibovynil.altervista.org/index.php Grazie.";
//             break;
//         default: 
//             break;
//     }
//     sendMail($to, $subject, $txt);
// }

function sendMail($to, $subject, $txt) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.libero.it';                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'unibovinyl@libero.it';                 
    $mail->Password   = 'Unibovinyl22!';                        
    $mail->Port       = 25;  
    $mail->setFrom('unibovinyl@libero.it', 'UniboVinyl');
    $mail->addAddress($to, 'Gentile cliente');
    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body    = $txt;
    $mail->AltBody = $txt;
   
    if(isset($to) && !empty($to) && isset($subject) && !empty($subject) && isset($txt) && !empty($txt)) {
        $mail->send();
    }
}
?>