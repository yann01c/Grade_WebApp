<?php
session_start();

$db = new SQLite3('sqlite/webapp.db');

$fkuser = $_SESSION['userID'];

$sql = $db->prepare("SELECT * FROM events WHERE fk_user = :user AND deleted = 'false' ORDER BY date ASC");
$sql->bindValue('user',$fkuser);

$result = $sql->execute();

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $id = $row['event_id'];
    $name = $row['eventname'];
    $date = $row['date'];
    $time = $row['time'];
    $desc = $row['description'];
    $priority = $row['priority'];

    if ($priority == "h") {
        $color = "rgba(230, 25, 25, 0.56);";
    }
    else if ($priority == "m") {
        $color = "rgba(25, 107, 230, 0.56);";
    }
    else if ($priority == "l") {
        $color = "rgba(25, 230, 25, 0.56)";
    }
    else {
        $color = "silver";
    }
    echo "<div style='background-color: $color;'>
            <p class='title'>$name</p>
            <p>$date</p>
            <p>$time</p>
            <p>$desc</p>
            <form action='calendar/delete_events.php' method='POST'>
                <input type='submit' name='e-delete' class='delete-event' value='Delete Event'>
                <input type='text' name='event_id' style='position:absolute;display:none;' value='$id'>
            </form>
        </div>";
}