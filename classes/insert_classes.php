<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $class) {
        
        $db = new SQLite3('../sqlite/webapp.db');
        
        // Remove spaces to prevent errors
        $new_class = preg_replace("/\s+/", "", $class);

        $userID = $_SESSION['userID'];

        $check = $db->prepare("SELECT class FROM class WHERE class = :class AND fk_user = :userid");
        $check->bindValue(':class',$new_class);
        $check->bindValue(':userid',$userID);
        $rcheck = $check->execute();
        $acheck = $rcheck->fetchArray();
        if ($acheck['class'] == $class) {
            echo "Class already exists!";
            exit();
        } else {
            echo "Class added: ".$new_class;
            $db->exec("INSERT INTO class (class,fk_user) VALUES ('$new_class','$userID')");
        }
    }
}
