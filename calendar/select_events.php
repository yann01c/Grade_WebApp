<?php
session_start();

$db = new SQLite3('sqlite/webapp.db');

$fkuser = $_SESSION['userID'];

$sql = $db->prepare("SELECT * FROM events WHERE fk_user = :user");
$sql->bindValue('user',$fkuser);

$result = $sql->execute();

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $name = $row['eventname'];
    $date = $row['date'];
    $time = $row['time'];
    $desc = $row['description'];
    echo "<div>
            <p>$name</p>
            <p>$date</p>
            <p>$time</p>
            <p>$desc</p>
        </div>";
}