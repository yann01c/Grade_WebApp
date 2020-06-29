<?php
session_start();

if(isset($_POST['change'])) {
    $db = new SQLite3('../sqlite/webapp.db');
    
    $username = $_POST['change-uid'];
    $email = $_POST['change-mail'];
    $group = $_POST['change-group'];
    $userID = $_SESSION['userID'];
    $uid = $_SESSION['userUID'];
    $mail = $_SESSION['userMAIL'];
    $userGRP  = $_SESSION['userGRP'];

    $sql = $db->prepare("SELECT * FROM login WHERE user_id = :id AND username = :uid");
    $sql->bindValue(':id',$userID);
    $sql->bindValue(':uid',$uid);
    $result = $sql->execute();
    $row = $result->fetchArray();
    
    if ($row['email'] == $email && $row['username'] == $username && $userGRP == $group) {
        header("Location: ../account.php?info=nothingchanged");
        exit();
    }

    // Check if any variable is empty
    if (empty($username) || empty($email)) {
        header("Location: ../account.php?lerror=emptyfields&l-uid=".$username."&l-email=".$email);
        exit();
    }
    // Check if mail and username are valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../account.php?lerror=invalidmailusername");
        exit();
    }
    // Check if mail is correct
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../account.php?lerror=invalidmail");
        exit();
    }
    // Check if username is correct
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../account.php?lerror=invalidusername");
        exit();
    }

    // Check if mail exists
    $existing_mail = $db->prepare("SELECT email FROM login WHERE email=:mail");
    $existing_mail->bindValue(':mail',$email);
    $result = $existing_mail->execute();

    $n_rows = 0;

    while ($row = $result->fetchArray()) {
        $n_rows += 1;
        if ($email == $row['email']) {
            $n_rows = 0;
        }
    }
    if ($n_rows == 1) {
        header("Location: ../account.php?error=mailtaken");
        exit();
    }

    // Check if username exists
    $sql = $db->prepare("SELECT username FROM login WHERE username=:uid");
    $sql->bindValue(':uid',$username);
    $r = $sql->execute();

    $nn_rows = 0;

    // Check number of rows
    while ($row = $r->fetchArray()) {
        $nn_rows += 1;
        if ($username == $row['username']) {
            $nn_rows = 0;
        }
    }
    if ($nn_rows == 1) { // = 1 -> Username already taken - go back to signup page
        header("Location: ../account.php?error=usertaken");
        exit();
    } else {
        $sql = $db->prepare("UPDATE login SET username = :uid,email = :email,'fk_group' = :group WHERE user_id = :userid");
        $sql->bindValue(':uid',$username);
        $sql->bindValue(':email',$email);
        $sql->bindValue(':group',$group);
        $sql->bindValue(':userid',$userID);
        $result = $sql->execute();
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../account.php?success=updated");
        exit();
    }
}