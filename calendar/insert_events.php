<?php
session_start();
if(isset($_POST['e-submit'])) {
    $event = $_POST['e-name'];
    $eventname = filter_var($event, FILTER_SANITIZE_STRING);
    $date = $_POST['e-date'];
    $t = $_POST['e-time'];
    $time = filter_var($t, FILTER_SANITIZE_STRING);
    $description = $_POST['e-description'];

    if (empty($date)) {
        header("Location: ../calendar.php?error=missingdate");
        exit();
    }
    if (empty($eventname)) {
        $eventname = "-";
    }
    if (empty($time)) {
        $time = "-";
    }
    if (empty($description)) {
        $description = "-";
    }

    $db = new SQLite3('../sqlite/webapp.db');

    $fkuser = $_SESSION['userID'];

    $sql = $db->prepare("INSERT INTO events (eventname,date,time,description,fk_user) VALUES (:event,:date,:time,:desc,:user)");
    if (!$sql) {
        header("Location: ../calendar.php?error=sql");
    }

    $sql->bindValue(':event',$eventname);
    $sql->bindValue(':date',$date);
    $sql->bindValue(':time',$time);
    $sql->bindValue(':desc',$description);
    $sql->bindValue('user',$fkuser);

    $result = $sql->execute();
    
    header("Location: ../calendar.php?info=submitted");
    exit();
}