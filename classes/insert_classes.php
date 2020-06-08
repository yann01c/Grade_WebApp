<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $class) {
        echo "Class added: ",$class;
    }
    $db = new SQLite3('../sqlite/webapp.db');
    $userID = $_SESSION['userID'];

    $check = $db->prepare("SELECT class FROM class WHERE class = :class AND fk_user = :userid");
    $check->bindValue(':class',$class);
    $check->bindValue(':userid',$userID);
    $rcheck = $check->execute();
    $acheck = $rcheck->fetchArray();
    if ($acheck['class'] == $class) {
        header("Location: ../classes.php?classexists");
        exit();
    } else {
        $sql = $db->prepare("SELECT fk_group FROM login WHERE user_id = :userid");
        $sql->bindValue(':userid',$userID);
        $r = $sql->execute();
        $row = $r->fetchArray();
        $fkgroup = $row['fk_group'];
        $db->exec("INSERT INTO class (class,fk_user,fk_group) VALUES ('$class','$userID','$fkgroup')");
    }
}
