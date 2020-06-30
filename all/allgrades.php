<?php

$db = new SQLite3('sqlite/webapp.db');

$userID = $_SESSION['userID'];

$sql = $db->prepare("SELECT * FROM grade WHERE fk_user = :user");
$sql->bindValue(':user',$userID);

$result = $sql->execute();

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

    echo "                    
    <tr>
        <td class='idtable'>$id</td>
        <td class='gradetable'>$grade</td>
        <td>$date</td>
        <td class='weightingtable'>$weighting%</td>
        <td>$description</td>
        <td>$created / $deleted</td>
        <td>$class</td>
    </tr>
    ";

}