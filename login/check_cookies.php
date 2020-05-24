<?php
if (isset($_COOKIE['username']) && isset($_COOKIE['identifier'])) {

    // Logout for cookies
    if (isset($_GET['cookie'])) {
        if ($_GET['cookie'] == "unset") {
            setcookie("username","",time() -3600);
            setcookie("identifier","",time() -3600);
            session_start();
            session_unset();
            session_destroy();
            header("Location: account.php?info=logout");
            exit();
        } else {
            header("Location: account.php");
            exit();
        }
    }

    $uid = $_COOKIE['username'];

    $db = new SQLite3('sqlite/webapp.db');

    // Select user
    $sql = $db->prepare("SELECT * FROM login WHERE username = :uid");
    $sql->bindValue(':uid',$uid);
    $result = $sql->execute();
    $row = $result->fetchArray();

    // Check if cookie identifier matches with db identifier
    if ($_COOKIE['username'] == $row['username'] && $_COOKIE['identifier'] == $row['identifier']) {

        // Get group FK
        $fkgroup = $row['fk_group'];
        $sql = $db->prepare("SELECT * FROM 'group' WHERE group_id = $fkgroup");
        $result = $sql->execute();
        $group = $result->fetchArray();

        // Start session
        $_SESSION['userID'] = $row['user_id'];
        $_SESSION['userUID'] = $row['username'];
        $_SESSION['userMAIL'] = $row['email'];
        $_SESSION['userGRP'] = $group['group'];
        $_SESSION['userGRPID'] = $group['group_id'];
        
        // Cookie status (COOKIE)
        //echo "<p style='position:absolute;color:white;padding:8px;margin:0;'>COOKIES FOUND</p>";

    // Cookie identifier / username does not match with db identifier / username
    } else {
        header("Location: account.php?error=nocookiematch");
        exit();
    }

// Cookie status (NO COOKIE)
} else {
    //echo "<p style='position:absolute;color:white;padding:8px;margin:0;'>NO COOKIES FOUND</p>";
}