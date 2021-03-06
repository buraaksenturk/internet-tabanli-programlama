<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Medoo.php';
 
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'itp',
	'server' => 'localhost',
	'username' => 'root',
	'password' => ''
]);

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

//KOD ÜRETME
$kod_icin1 = date('d.m.Y H:i:s');
$kod_icin2 = rand(0,20000);
$aktivasyon_dkod = hash('sha256', $kod_icin2.$kod_icin1);

$kAd="";
if(isset($_POST["kad"])){
        $kAd=$_POST["kad"];
        //Kayıt işlemi yapmalıyız
        $sifre = $database->get("users","sifre",["kad" => $kAd]);
        #try-catch
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'phpmaildeneme1@gmail.com';                     // SMTP username
            $mail->Password   = 'php?deneme1';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('phpmaildeneme1@gmail.com', 'Php Mail Deneme');
            $mail->addAddress($kAd, 'Yeni Kullanıcı');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Şifre hatırlatma';
            $mail->Body    = '<h3>Unutulan şifreniz :'.$sifre.'</h3>';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        
}
?>
<form action="" method="post">
        Kullanıcı Adı <input type="text" name="kad"><br>
        <input type="submit" value="hatırlat"><br>
</form>