<?php
if (isset($_POST['login'])) {

    // POST vars
    $username = $_POST['a-username'];
    $password = $_POST['a-password'];
    if(!empty($_POST['remember'])) {
        $remember = $_POST['remember'];
    }

    // Check if fields are missing
    if (empty($username) || empty($password)) {
        header("Location: ../account.php?error=emptyfields");
        exit();
    } else {
        $db = new SQLite3('../sqlite/webapp.db');
        $sql = $db->prepare("SELECT * FROM login WHERE username=:uid OR email=:mail");

        // if SQL statement fails
        if (!$sql) {
            header("Location: ../account.php?error=sqlerror");
            exit();
        } else {

            // Bind values & execute prepared statement
            $sql->bindValue(':uid',$username);
            $sql->bindValue(':mail',$username);
            $r = $sql->execute();

            // Check if user exists
            if ($row = $r->fetchArray()) {
                $pwdCheck = password_verify($password, $row['passwd']);

                // Password does not match
                if ($pwdCheck == false) {
                    header("Location: ../account.php?error=wrongpassword&uid=$username");
                    exit();
                }

                // Password matches
                else if ($pwdCheck == true) {
                    $fkgroup = $row['fk_group'];
                    $sql = $db->prepare("SELECT * FROM 'group' WHERE group_id = $fkgroup");
                    $result = $sql->execute();
                    $group = $result->fetchArray();

                    // "Remember me" checkbox checked
                    if (!empty($remember)) {
                        header("Location: set_cookies.php?uid=$username");
                        exit();
                    }

                    // Start session if "Remember me" was not checked
                    session_start();
                    $_SESSION['userID'] = $row['user_id'];
                    $_SESSION['userUID'] = $row['username'];
                    $_SESSION['userMAIL'] = $row['email'];
                    $_SESSION['userGRP'] = $group['group'];
                    $_SESSION['userGRPID'] = $group['group_id'];
                    
                    header("Location: ../account.php?login=success");
                    exit();
                }
            } else {
                header("Location: ../account.php?error=nouser");
                exit();
            }
        }
    }

// If page is accessed manually
} else {
    header("Location: ../account.php");
    exit();
}