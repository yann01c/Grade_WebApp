<?php

if (isset($_POST['e-delete'])) {

    $event = $_POST['event_id'];
    $eventid = filter_var($event, FILTER_SANITIZE_STRING);

    $db = new SQLite3('../sqlite/webapp.db');

    $sql = $db->prepare("UPDATE events SET deleted = 'true' WHERE event_id = :eid");
    if (!$sql) {
        header("Location: ../calendar.php?error=sql");
        exit();
    }
    $sql->bindValue(':eid',$eventid);
    $result = $sql->execute();

    echo "Deleted";
}