<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $class) {
        
        $db = new SQLite3('../sqlite/webapp.db');
        
        $userID = $_SESSION['userID'];
        $groupID = $_SESSION['userGRPID'];

        $check = $db->prepare("SELECT class FROM class WHERE class = :class AND fk_user = :userid AND fk_group = :fkg");
        $check->bindValue(':class',$class);
        $check->bindValue(':userid',$userID);
        $check->bindValue(':fkg',$groupID);
        $rcheck = $check->execute();
        $acheck = $rcheck->fetchArray();
        if ($acheck['class'] == $class) {
            $txt = "Class already exists!";
            echo $txt;
            exit();
        } else {
            $txt = "Class added: ".$class;
            echo $txt;
            $db->exec("INSERT INTO class (class,fk_user,fk_group) VALUES ('$class','$userID','$groupID')");
        }
    }
        
        //$sql = $db->prepare("SELECT fk_group FROM login WHERE user_id = :userid");
        //$sql->bindValue(':userid',$userID);
        //$r = $sql->execute();
        //$row = $r->fetchArray();
        //$fkgroup = $row['fk_group'];
}
