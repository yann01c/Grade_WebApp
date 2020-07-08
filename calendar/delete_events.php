<?php

if (isset($_POST['e-delete'])) {

    $event = $_POST['event_id'];
    $eventid = filter_var($event, FILTER_SANITIZE_STRING);
    $userID = $_SESSION['userID'];


    $db = new SQLite3('../sqlite/webapp.db');

    $sql = $db->prepare("UPDATE events SET deleted = 'true' WHERE event_id = :eid AND fk_user = :user");
    if (!$sql) {
        header("Location: ../calendar.php?error=sql");
        exit();
    }
    $sql->bindValue(':eid',$eventid);
    $sql->bindValue(':user',$userID);
    $result = $sql->execute();

    header("Location: ../calendar.php?info=deleted");
    exit();
}
// else {
//     header("Location: ../account.php");
//     exit();
// }