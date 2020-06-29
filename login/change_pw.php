<?php
if (isset($_POST['changepw'])) {
    session_start();
    $old = $_POST['old'];
    $new1 = $_POST['new1'];
    $new2 = $_POST['new2'];
    $userID = $_SESSION['userID'];

    // Check if fields are missing
    if (empty($old) || empty($new1) || empty($new2)) {
        header("Location: ../change_password.php?error=emptyfields");
        exit();
    }
    if ($new1 != $new2) {
        header("Location: ../change_password.php?error=notmatching");
        exit();
    }

    $db = new SQLite3('../sqlite/webapp.db');
    
    $sql = $db->prepare("SELECT * FROM login WHERE user_id = :id");

    if (!$sql) {
        header("Location: ../account.php?error=sqlerror");
        exit();
    }

    $sql->bindValue(':id',$userID);
    $r = $sql->execute();

    // Check if old password matches
    if ($row = $r->fetchArray()) {
        $pwdCheck = password_verify($old, $row['passwd']);
        // Password does not match
        if ($pwdCheck == false) {
            header("Location: ../change_password.php?error=wrongpassword");
            exit();
        }

        // Password matches
        else if ($pwdCheck == true) {
            $passwordHashed = password_hash($new1, PASSWORD_DEFAULT);
            $sqlu = $db->prepare("UPDATE login SET passwd = :newpw WHERE user_id = :userid");
            $sqlu->bindValue(':newpw',$passwordHashed);
            $sqlu->bindValue(':userid',$userID);
            $uresult = $sqlu->execute();
            if (isset($_COOKIE['username']) && isset($_COOKIE['identifier'])) {
                header("Location: ../account.php?cookie=unset");
            } else {
                session_start();
                session_unset();
                session_destroy();
                header("Location: ../account.php?info=changed");
            }
        } else {
            header("Location: ../change_password.php");
            exit();
        }
    }
}