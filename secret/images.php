<?php
$db = new SQLite3('sqlite/webapp.db');

$userID = $_SESSION['userID'];

// Select every file with the session userID
$gsql = $db->prepare("SELECT * FROM file WHERE fk_user = :user");
$gsql->bindValue(':user',$userID);
$gresult = $gsql->execute();

$c = 0;

while ($row = $gresult->fetchArray()) {
    
    $c++;
    $path = $row['filename'];

    echo "<img src='$path' id='$c' style='padding:;cursor:pointer;' onclick='zoom(this.id)'>";
    echo "<input value='$path' id='path$c' style='position:absolute;display:none;'>";
}