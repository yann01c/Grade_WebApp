<?php
$db = new SQLite3('sqlite/webapp.db');

$userID = $_SESSION['userID'];

$gsql = $db->prepare("SELECT grade_id FROM grade WHERE fk_user = :user");
$gsql->bindValue(':user',$userID);
$gresult = $gsql->execute();

$i = 0;
$a = 0;

while ($grow = $gresult->fetchArray()) {
    $i++;

    $gradeid[$i] = $grow['grade_id'];


    $sql = $db->prepare("SELECT * FROM file_grade WHERE fk_grade = :grade");
    $sql->bindValue(':grade',$gradeid[$i]);
    $result = $sql->execute();

    while ($row = $result->fetchArray()) {
        $a++;
        $fkfile[$a] = $row['fk_file'];
    }
}

$f = 1;

for ($f = 1; $f <= $a; $f++) {
    $isql = $db->prepare("SELECT * FROM file WHERE file_id = :fileid");
    $isql->bindValue(':fileid',$fkfile[$f]);
    $iresult = $isql->execute();
    $irow = $iresult->fetchArray();

    $path = $irow['filename'];

    echo "<img src='$path' style='width:100px;height:100px;cursor:pointer;padding: 8px;'>";
}