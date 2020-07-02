<?php
session_start();
if (isset($_POST['reset-password'])) {

    $mail = $_POST['email'];
    
    if (empty($mail)) {
        header("Location: ../reset.php?error=empty");
        exit();
    }

    $email = filter_var($mail, FILTER_SANITIZE_STRING);
    
    $userid = $_SESSION['userID'];

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

        $token = md5(uniqid(rand(), true));

        $tsql = $db->prepare("INSERT INTO token (email,token) VALUES (:email,:token)");
        $tsql->bindValue(':email',$row['email']);
        $tsql->bindValue('token',$token);

        $tresult = $tsql->execute();

        $username = $row['username'];

        // Send mail
        $to = $row['email'];
        $subject = "Reset your Password on GRADES";
        $msg = "Hello ".$username.", you can reset your password here: <a href='10.123.123.123/reset.php?token=$token'>RESET</a>";
        $msg = wordwrap($msg,70);
        $headers = "From: info@grades.ch";
        
        mail($to, $subject, $msg, $headers);
        header("Location: ../pending.php?email=$email");

    }


} else {
    // If accessed manually
    header("Location: ../account.php");
    exit();
}