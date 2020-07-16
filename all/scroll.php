<?php

$db = new SQLite3("sqlite/webapp.db");

$user = $_SESSION['userID'];

$sql = $db->prepare("SELECT fk_class FROM grade WHERE fk_user = :user ORDER BY fk_class ASC");
$sql->bindValue(':user',$user);
$result = $sql->execute();

$count = 0;

$checkclass = "";

while ($row = $result->fetchArray()) {
    $fkclass = $row['fk_class'];

    $csql = $db->prepare("SELECT class FROM class WHERE class_id = :id");
    $csql->bindValue(':id',$fkclass);

    $cresult = $csql->execute();

    $crow = $cresult->fetchArray();

    $class = $crow['class'];

    $count++;

    if ($checkclass != $class) {
        echo "<div class='n-div'><a class='navigation' onclick='' class='$class' href='#$class'>$class</a></div>";
        $checkclass = $class;
    }
}