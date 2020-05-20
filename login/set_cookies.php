<?php
if (isset($_GET['uid'])) {
        $db = new SQLite3('../sqlite/webapp.db');
        $uid = $_GET['uid'];
        $sql = $db->prepare("SELECT * FROM login WHERE username = :uid");
        $sql->bindValue(':uid',$uid);
        $result = $sql->execute();
        $row = $result->fetchArray();
        
        $identifier = md5(uniqid(rand(), true));
        setcookie("username",$uid,time()+ 1000,"/");
        setcookie("identifier",$identifier,time()+ 1000,"/");

        $sql = $db->prepare("UPDATE login SET identifier = :random WHERE username = :user");
        $sql->bindValue(':random',$identifier);
        $sql->bindValue(':user',$uid);
        $result = $sql->execute();

        if ($_COOKIE['username'] == $uid && $_COOKIE['identifier'] == $row['identifier']) {
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

            header("Location: ../account.php?login=success?cookie=set");
            exit();
        } else {
            header("Location: ../account.php?error=wrongcookie");
            exit();
        }
} else {
    header("Location: ../account.php");
    exit();
}