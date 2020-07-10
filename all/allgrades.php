<?php

$db = new SQLite3('sqlite/webapp.db');

$userID = $_SESSION['userID'];

$sql = $db->prepare("SELECT * FROM grade WHERE fk_user = :user");
$sql->bindValue(':user',$userID);

$result = $sql->execute();
$checkclass = "";

while ($row = $result->fetchArray()) {
    
    $id = $row['grade_id'];
    $grade = $row['grade'];
    $date = $row['date'];
    $weighting = $row['weighting'] * 100;
    $description = $row['description'];
    $created = $row['timestamp'];
    $deleted = $row['deleted'];

    $fkclass = $row['fk_class'];

    $csql = $db->prepare("SELECT class FROM class WHERE class_id = :classid");
    $csql->bindValue(':classid',$fkclass);

    $cresult = $csql->execute();

    $crow = $cresult->fetchArray();
    
    $class = $crow['class'];

    if ($checkclass != $class) {
        echo "<div class='title-wrapper'><h1>$class</h1></div>";
        $checkclass = $class;
    }
    echo "                    
    <div class='grades-wrapper'>";

    echo "
        <p class='gradetable' style='font-weight:bold;'>$grade</p>
        <p>$date</p>
        <p class='weightingtable'>$weighting%</p>
        <p>$created / $deleted</p>
        <p>$class</p>
    </div>
    ";

}