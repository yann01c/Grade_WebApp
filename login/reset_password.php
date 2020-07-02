<?php
use PHPMailer\PHPMailer\PHPmMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Execption;

require '../phpmailer/src/Exeption.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if (isset($_POST['reset-password'])) {

    $mail = $_POST['email'];
    
    if (empty($mail)) {
        header("Location: ../reset.php?error=empty");
        exit();
    }

    $email = filter_var($mail, FILTER_SANITIZE_STRING);
    
    $db = new SQLite3('../sqlite/webapp.db');

    $sql = $db->prepare("SELECT * FROM login WHERE email = :mail");
    if (!$sql) {
        header("Location: ../account.php?error=sql");
        exit();
    } else {
        $sql->bindValue(':mail',$email);
        $result = $sql->execute();
        $row = $result->fetchArray();

        if (empty($row['email'])) {
            header("Location: ../reset.php?error=notexist");
            exit();
        }

        $check = $db->prepare("SELECT * FROM token WHERE email = :m");
        $check->bindValue(":m",$row['email']);
        $cresult = $check->execute();
        $crow = $cresult->fetchArray();

        if (empty($crow['token']) && empty($crow['email'])) {
            $token = md5(uniqid(rand(), true));

            $tsql = $db->prepare("INSERT INTO token (email,token,timestamp) VALUES (:email,:token,datetime('now','localtime'))");
            $tsql->bindValue(':email',$row['email']);
            $tsql->bindValue(':token',$token);

            $tresult = $tsql->execute();
        } else {
            $token = md5(uniqid(rand(), true));

            $usql = $db->prepare("UPDATE token SET token = :newtoken, timestamp = datetime('now','localtime') WHERE email = :newemail");
            $usql->bindValue(':newtoken',$token);
            $usql->bindValue(':newemail',$row['email']);
            
            $uresult = $usql->execute();
        }

        $username = $row['username'];

        // Send mail
        $to = $row['email'];
        $subject = "Reset your Password, ".$username;
        $msg = "Hello ".$username.", you can reset your password here: <a href='10.123.123.123/new_password.php?token=$token'>RESET</a>";

        $mail = new PHPMailer(true);

        try {
            // Server
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host      = '100.100.125.35';
            $mail->Port      = 25;

            // Recipients
            $mail->setFrom('grades@spie.ch','Mailer');
            $mail->addAddress($to,$username);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $username;
            $mail->Body    = $msg;
            $mail->AltBody = $msg;

            $mail->send();
        
            echo 'Message has been sent';
        
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


        $msg = "Hello ".$username.", you can reset your password here: <a href='10.123.123.123/new_password.php?token=$token'>RESET</a>";
        $msg = wordwrap($msg,70);
        $headers = "From: grades@spie.ch";
        
        mail($to, $subject, $msg, $headers);
        header("Location: ../pending.php?email=$email");
        exit();
    }
}

if (isset($_POST['new-password'])) {
    $new1 = $_POST['new1'];
    $new2 = $_POST['new2'];
    $passed_token = $_POST['passed_token'];
    
    $db = new SQLite3('../sqlite/webapp.db');

    if (empty($new1) || empty($new2)) {
        header("Location: new_password?token=$passed_token&error=empty");
        exit();
    }
    if ($new1 != $new2) {
        header("Location: new_password?token=$passed_token&error=notmatching");
        exit();
    }

    $ksql = $db->prepare("SELECT * FROM token WHERE token = :token");
    $ksql->bindValue(':token',$passed_token);
    $kresult = $ksql->execute();
    $krow = $kresult->fetchArray();

    $passwordHashed = password_hash($new2, PASSWORD_DEFAULT);

    $sql1 = $db->prepare("UPDATE login SET passwd = :newpw WHERE email = :themail");
    $sql1->bindValue(':newpw',$passwordHashed);
    $sql1->bindValue(':themail',$krow['email']);
    $result1 = $sql1->execute();
    $row1 = $result1->fetchArray();

    header("Location: ../account.php?success=newpw");
    exit();
}