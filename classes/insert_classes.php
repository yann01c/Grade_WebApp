<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $class) {
        echo "Class added: ",$class;
    }
    $db = new SQLite3('../sqlite/webapp.db');
    $userID = $_SESSION['userID'];
    $sql = $db->prepare("SELECT fk_group FROM login WHERE user_id = :userid");
    $sql->bindValue(':userid',$userID);
    $r = $sql->execute();
    $row = $r->fetchArray();
    $fkgroup = $row['fk_group'];
    $db->exec("INSERT INTO class (class,fk_group) VALUES ('$class','$fkgroup')");
}
?>