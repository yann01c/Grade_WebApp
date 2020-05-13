<?php
if (isset($_GET['c1-class']) || (isset($_POST['c1-class']))) {
    // why do you need two variables with the same value?
if (empty($_GET['c1-class'])) {
    $fkclass = $_POST['c1-class'];
    $class = $_POST['c1-class'];
} else {
    $fkclass = $_GET['c1-class'];
    $class = $_GET['c1-class'];
}
$db = new SQLite3('sqlite/webapp.db');
$userID = $_SESSION['userID'];

$fk = $db->prepare("SELECT class_id FROM class WHERE class = :class");
$fk->bindValue(':class',$fkclass);
$r = $fk->execute();
$rr = $r->fetchArray();
$fkclass = $rr['class_id'];

$sql = $db->prepare("SELECT * FROM grade WHERE fk_user = :userid AND fk_class = :fkclass");
$sql->bindValue(':userid',$userID);
$sql->bindValue(':fkclass',$fkclass);
$result = $sql->execute();
$count = 0;
$check = 0;
$number = 0;
$px = "'400px'";
$pos = 'absolute';
$onclick = "onclick=this.style.height = '400px';";

// Select every grade in grade and display it in "option" element in HTML
while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
    if ($row['grade'] >= 5.0) {
        $color = 'green';
        $count = $count + 1;
    }
    else if ($row['grade'] >= 4.0 && $row['grade'] <= 4.9) {
        $color = 'orange';
        $count = $count + 2;
    }
    else if ($row['grade'] <= 3.9) {
        $color = 'red';
        $count = $count + 3;
    }
    $id = $row['grade_id'];
    $grade = $row['grade'];
    $weighting = $row['weighting'] * 100;
    $userID = $_SESSION['userID'];
    $pathtofile = "upload/".$row['filename'];
    $number = $number + 1;

    $style = '<style type="text/css">#class-grade'.$count.'{color:'.$color.'; font-weight: bold;}</style>';
    //echo "<div class='gradelist'>";
    echo $style;
    echo "<form action='class/delete_grade.php' method='post'>";
    $check++;
    $img = "<img src='upload/".$row['filename']."' id='screenshotimg' onclick='zoom()'>";
        echo "<table>
        <caption sytle='color:white;'></caption>
        <thead>
        <tr>
            <th scope='col' style='color:black;'>Grade</th>
            <th scope='col'>Date</th>
            <th scope='col'>Weighting</th>
            <th scope='col'>Description</th>
            <th scope='col'>Screenshots</th>
            <th scope='col'></th>
        </tr>
        </thead>";
    echo "<tbody>
            <tr id='$count' onclick='collapse(this.id)' style='cursor:pointer;'>
                <td id='class-grade$count' data-label='Grade' style='display:block;'>".$row['grade']."</td>
                <td class='td$count' data-label='Date'>".$row['date']."</td>
                <td class='td$count' data-label='Weighting'>".$weighting."%"."</td>
                <td class='td$count' data-label='Description'>".$row['description']."</td>
                <td class='td$count' data-label='Screenshots'>$img</td>
                <td class='td$count' data-label=''><button type='submit' name='delete_btn' onclick='zoom()'>DELETE</button></td>
            </tr>
        </tbody>
        </table>";
    echo "<input type='text' name='delete_id' value='$id' style='display: none; position: absolute;'>";
    echo "<input type='text' name='delete_grade' value='$grade' style='display: none; position: absolute;'>";
    echo "<input type='text' name='class' value='$class' style='display: none; position: absolute;'>";
    echo "</form>";
    }
}
