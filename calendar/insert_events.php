<?php
session_start();
if(isset($_POST['e-submit'])) {
    $eve = $_POST['e-name'];
    $eventname = filter_var($eve, FILTER_SANITIZE_STRING);
    $date = $_POST['e-date'];
    $tim = $_POST['e-time'];
    $time = filter_var($tim, FILTER_SANITIZE_STRING);
    $des = $_POST['e-description'];
    $description = filter_var($des, FILTER_SANITIZE_STRING);
    $rem = $_POST['e-reminder'];
    $reminder = filter_var($rem, FILTER_SANITIZE_STRING);

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

    $sql = $db->prepare("INSERT INTO events (eventname,date,time,description,deleted,fk_user,reminder) VALUES (:event,:date,:time,:desc,'false',:user,:reminder)");
    if (!$sql) {
        header("Location: ../calendar.php?error=sql");
    }

    $sql->bindValue(':event',$eventname);
    $sql->bindValue(':date',$date);
    $sql->bindValue(':time',$time);
    $sql->bindValue(':desc',$description);
    $sql->bindValue(':user',$fkuser);
    $sql->bindValue(':reminder',$reminder);

    $result = $sql->execute();
    
    header("Location: ../calendar.php?info=submitted");
    exit();
}