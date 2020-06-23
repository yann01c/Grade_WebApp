<?php
$db = new SQLite3('sqlite/webapp.db');

$userID = $_SESSION['userID'];

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



// $gsql = $db->prepare("SELECT * FROM grade WHERE fk_user = :user");
// $gsql->bindValue(':user',$userID);
// $gresult = $gsql->execute();

// $i = 0;
// $a = 0;

// while ($grow = $gresult->fetchArray()) {
//     $i++;

//     $gradeid[$i] = $grow['grade_id'];

//     if (!empty($gradeid[$i])) {
//         $sql = $db->prepare("SELECT * FROM file_grade WHERE fk_grade = :grade");
//         $sql->bindValue(':grade',$gradeid[$i]);
//         $result = $sql->execute();
    
//         while ($row = $result->fetchArray()) {
//             $a++;
//             $fkfile[$a] = $row['fk_file'];
//         }
//     }
// }

// $f = 1;
// $c = 0;

// for ($f = 1; $f <= $a; $f++) {
//     $c++;
//     $isql = $db->prepare("SELECT * FROM file WHERE file_id = :fileid");
//     $isql->bindValue(':fileid',$fkfile[$f]);
//     $iresult = $isql->execute();
//     $irow = $iresult->fetchArray();

//     $path = $irow['filename'];
//     echo "<img src='$path' id='$c' style='padding:;cursor:pointer;' onclick='zoom(this.id)'>";
//     echo "<input value='$path' id='path$c' style='position:absolute;display:none;'>";
// }