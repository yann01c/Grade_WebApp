<?php
session_start();
if(isset($_GET['e-submit'])) {
    $eve = $_GET['e-name'];
    $eventname = filter_var($eve, FILTER_SANITIZE_STRING);
    $date = $_GET['e-date'];
    $tim = $_GET['e-time'];
    $time = filter_var($tim, FILTER_SANITIZE_STRING);
    $des = $_GET['e-description'];
    $description = filter_var($des, FILTER_SANITIZE_STRING);
    $rem = $_GET['e-reminder'];
    $reminder = filter_var($rem, FILTER_SANITIZE_STRING);
    $pri = $_GET['e-priority'];
    $priority = filter_var($pri, FILTER_SANITIZE_STRING);

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
    echo "TEST";
    $db = new SQLite3('../sqlite/webapp.db');

    $fkuser = $_SESSION['userID'];
    $email = $_SESSION['userMAIL'];
    
    $sql = $db->prepare("INSERT INTO events (eventname,date,time,description,deleted,fk_user,reminder,email,priority,'check') VALUES (:event,:date,:time,:desc,'false',:user,:reminder,:email,:priority,'0')");
    if (!$sql) {
        header("Location: ../calendar.php?error=sql");
    }

    $sql->bindValue(':event',$eventname);
    $sql->bindValue(':date',$date);
    $sql->bindValue(':time',$time);
    $sql->bindValue(':desc',$description);
    $sql->bindValue(':user',$fkuser);
    $sql->bindValue(':reminder',$reminder);
    $sql->bindValue(':email',$email);
    $sql->bindValue(':priority',$priority);

    $result = $sql->execute();
    
    header("Location: ../calendar.php");
    exit();
}