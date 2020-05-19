<?php
if (isset($_POST['login'])) {
    $username = $_POST['a-username'];
    $password = $_POST['a-password'];
    $remember = $_POST['remember'];
    if (empty($username) || empty($password)) {
        header("Location: ../account.php?error=emptyfields");
        exit();
    } else {
        $db = new SQLite3('../sqlite/webapp.db');
        $sql = $db->prepare("SELECT * FROM login WHERE username=:uid OR email=:mail");
        if (!$sql) {
            header("Location: ../account.php?error=sqlerror");
            exit();
        } else {
            $sql->bindValue(':uid',$username);
            $sql->bindValue(':mail',$username);
            $r = $sql->execute();
            if ($row = $r->fetchArray()) {
                $pwdCheck = password_verify($password, $row['passwd']);
                if ($pwdCheck == false) {
                    header("Location: ../account.php?error=wrongpassword");
                    exit();
                }
                else if ($pwdCheck == true) {
                    $fkgroup = $row['fk_group'];
                    $sql = $db->prepare("SELECT * FROM 'group' WHERE group_id = $fkgroup");
                    $result = $sql->execute();
                    $group = $result->fetchArray();
                    session_start();
                    $_SESSION['userID'] = $row['user_id'];
                    $_SESSION['userUID'] = $row['username'];
                    $_SESSION['userMAIL'] = $row['email'];
                    $_SESSION['userGRP'] = $group['group'];
                    $_SESSION['userGRPID'] = $group['group_id'];
                    
                    $userid = $_SESSION['userID'];

                    $bytes = random_bytes(20);
                    $string = var_dump(bin2hex($bytes));

                    if (!empty($remember)) {
                        header("Location: set_cookies.php?uid=$username");
                        exit();
                    }
                    
                    header("Location: ../account.php?login=success");
                    exit();
                } else {
                    header("Location: ../account.php?error=wrongpwd");
                    exit();
                }
            } else {
                header("Location: ../account.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: ../account.php");
    exit();
}