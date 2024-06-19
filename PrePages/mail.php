<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $mail = new PHPMailer(true);

    $sender = "yigerem4@gmail.com";
    $senderAppPassword = 'qocz yruo ybjx vmld';
    $sentTo = $_POST['email'];
    $receiverName = $_POST['first-name']. " ". $_POST['father-name'];

    function generateRandomCode($length = 16){
        return bin2hex(random_bytes($length/2));
    }

    $code = generateRandomCode();

    $subject = "Verification Code";
    $body = "Dear $receiverName, your account verification code is <b>$code</b> . Use this code to login to your account.";

    try {
        // Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                           // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';      // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                  // Enable SMTP authentication
        $mail->Username   = 'yigerem4@gmail.com';// SMTP username
        $mail->Password   = 'qocz yruo ybjx vmld'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                   // TCP port to connect to

        // Recipients
        $mail->setFrom('yigerem4@gmail.com', 'Yigerem Bisrat');
        $mail->addAddress('yigerem.bisrat@a2sv.org', 'Yigerem Bisrat'); // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
