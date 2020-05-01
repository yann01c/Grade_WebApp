<?php
if(isset($_POST['register'])) {
    $username = $_POST['r-uid'];
    $email = $_POST['r-email'];
    $passwd = $_POST['r-pwd'];
    $rpasswd = $_POST['r-rpwd'];
    $group = $_POST['r-group'];

    // Check group ID
    // try to avoid hardcoded values :/
    // still I like the idea of input validation
   // if ($group == "IT") {
   //     $group = 2;
   // }
   // else if ($group == "KV") {
   //     $group = 1;
   // } else {
   //     header("Location: ../register.php?error=invalidgroup");
   //     exit();
   // }

    // Open DB
    $db = new SQLite3('../sqlite/webapp.db');

    // Check if any variable is empty
    if (empty($username) || empty($email) || empty($passwd) || empty($rpasswd)) {
        header("Location: ../register.php?error=emptyfields&r-uid=".$username."&r-email=".$email);
        exit();
    }

    // Check if mail and username are valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../register.php?error=invalidmailusername");
        exit();
    }
    // Check if mail is valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=invalidmail&r-uid=".$username);
        exit();
    }
    // Check if username is correct
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../register.php?error=invalidusername&r-email=".$email);
        exit();
    }

    // Check if passwords match
    else if ($passwd !== $rpasswd) {
        header("Location: ../register.php?error=passwordcheck&r-uid=".$username."&r-email=".$email);
        exit();
    }

    // Check if mail exists
    $mail = $db->prepare("SELECT email FROM login WHERE email=:mail");
    $mail->bindValue(':mail',$email);
    $result = $mail->execute();
    $n_rows = 0;

    while ($row = $result->fetchArray()) {
        $n_rows += 1;
    }
    if ($n_rows == 1) {
        header("Location: ../register.php?error=mailtaken");
        exit();
    }

    // Check if username exists
    $sql = $db->prepare("SELECT username FROM login WHERE username=:uid");
    $sql->bindValue(':uid',$username);
    $r = $sql->execute();

    $number_of_rows = 0;

    // Check number of rows
    while ($row = $r->fetchArray()) {
        $number_of_rows += 1;
    }
    if ($number_of_rows == 1) { // = 1 -> Username already taken - go back to signup page
        header("Location: ../register.php?error=usertaken");
        exit();
    } else { // = 0 -> Username not taken - Insert cred into DB
        $passwordHashed = password_hash($passwd, PASSWORD_DEFAULT);
        $sql = $db->prepare("INSERT INTO login (username,email,passwd,fk_group) VALUES (:uid,:mail,:pwd,:group)");
        $sql->bindValue(':uid',$username);
        $sql->bindValue(':mail',$email);
        $sql->bindValue(':pwd',$passwordHashed);
        $sql->bindValue(':group',$group);
        $r = $sql->execute();
        header("Location: ../account.php?signup=success");
        //exit();
        //echo "FINITO";
    }
    $db->close();
} else { // When accessed manually, send user back to signup page
    header("Location: ../register.php");
    exit();
}
