<?php
if (isset($_GET['uid'])) {
    
    $db = new SQLite3('../sqlite/webapp.db');

    $uid = $_GET['uid'];

    // Select user
    $sql = $db->prepare("SELECT * FROM login WHERE username = :uid");
    $sql->bindValue(':uid',$uid);
    $result = $sql->execute();
    $row = $result->fetchArray();
    
    // Generate identifier string and set cookies
    $identifier = md5(uniqid(rand(), true));
    setcookie("username",$uid,time()+ 604800,"/");
    setcookie("identifier",$identifier,time()+ 604800,"/"); // 604800s -> 1 Woche

    // Set identifier for cookie auth
    $sql = $db->prepare("UPDATE login SET identifier = :random WHERE username = :user");
    $sql->bindValue(':random',$identifier);
    $sql->bindValue(':user',$uid);
    $result = $sql->execute();

    // Get group FK
    $fkgroup = $row['fk_group'];
    $sql = $db->prepare("SELECT * FROM 'group' WHERE group_id = $fkgroup");
    $result = $sql->execute();
    $group = $result->fetchArray();

    // Back to account with cookies set
    header("Location: ../account.php?login=success&cookie=set");
    exit();

} else {
    header("Location: ../account.php");
    exit();
}