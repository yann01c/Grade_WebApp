<?php
if (isset($_GET['c1-class']) || isset($_POST['c1-class']) || isset($_POST['user-pre'])) {

    // Check if GET(c1) and POST(c1) requests are empty
    if (empty($_GET['c1-class']) && empty($_POST['c1-class'])) {
        // Assign POST(c2)
        $class = $_POST['c2-class'];
    }

    // Check if POST(c1) is empty
    else if (empty($_POST['c1-class'])) {
        // Assign GET(c1)
        $class = $_GET['c1-class'];
    } 

    // Check if GET(c1) is empty
    else if (empty($_GET['c1-class'])) {
        // Assign POST(c1)
        $class = $_POST['c1-class'];
    }

    $db = new SQLite3('sqlite/webapp.db');

    // Check if request was made from group "Berufsbildner"
    if (isset($_POST['user-pre'])) {
        $userID = $_POST['bbid'];
    } else {
        $userID = $_SESSION['userID'];
    }

    // Prepare SELECT statement for table "class"
    $sqlfk = $db->prepare("SELECT class_id FROM class WHERE class = :class");
    // If statement runs into an error
    if (!$sqlfk) {
        echo "<p style='color:orange;font-weight:bold;'>SQLite Error</p>";
        exit();
    }

    // Bind & Execute
    $sqlfk->bindValue(':class',$class);
    $r = $sqlfk->execute();
    $rr = $r->fetchArray();
    $fkclass = $rr['class_id'];

    // Prepare SELECT statement for table "grade"
    $sql = $db->prepare("SELECT * FROM grade WHERE fk_user = :userid AND fk_class = :fkclass");
    // If statement runs into an error
    if (!$sql) {
        echo "<p style='color:orange;font-weight:bold;'>SQLite Error</p>";
        exit();
    }
    // Bind & Execute
    $sql->bindValue(':userid',$userID);
    $sql->bindValue(':fkclass',$fkclass);
    $result = $sql->execute();

    // Count / Check vars
    $count = 0;
    $count2 = 0;
    $check = 0;
    $number = 0;

    // Select every grade in grade and display it in "option" element in HTML (WHILE statement returns)
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {

        $grade_id = $row['grade_id'];

        // Prepare SELECT statement for file_grade
        $sqlfilegrade = $db->prepare("SELECT fk_file FROM file_grade WHERE fk_grade = :file_grade");
        $sqlfilegrade->bindValue(':file_grade',$grade_id);
        $rfg = $sqlfilegrade->execute();
        $afg = $rfg->fetchArray();
        
        echo "GRADE ID= ".$grade_id;
        echo "AFG= ".$afg['fk_file'];

        // Prepare SELECT statement for file
        $sqlfile = $db->prepare("SELECT * FROM file WHERE file_id = :fk_file");
        $sqlfile->bindValue(':fk_file',$afg['fk_file']);
        $res = $sqlfile->execute();
        $testa = $res->fetchArray();
        echo "TEST= ".$testa['filename'];

        // Grade greater or equal to 5.0 gets color GREEN
        if ($row['grade'] >= 5.0) {
            $color = 'green';
            $count = $count + 1;
        }
        // Grade greater or equal to 4.0 gets color ORANGE
        else if ($row['grade'] >= 4.0 && $row['grade'] <= 4.9) {
            $color = 'orange';
            $count = $count + 2;
        }
        // Grade smaller or equal to 3.9 gets color ORANGE
        else if ($row['grade'] <= 3.9) {
            $color = 'red';
            $count = $count + 3;
        }

        // Set vars
        $id = $row['grade_id'];
        $grade = $row['grade'];
        $weighting = $row['weighting'] * 100;
        $userID = $_SESSION['userID'];
        //$pathtofile = "upload/".$row['filename'];
        $number = $number + 1;
        $count2++;
        //$uploadimg = $row['filename'];

        // Input with path value (used for zoom.js ZOOM function)
        //echo "<input id='imginput$count2' value='$uploadimg' style='display:none;position:absolute;'>";

        $style = '<style type="text/css">.class-grade'.$count.'{color:'.$color.'; font-weight: bold;}</style>';
        echo $style;

        // Echo tables with content
        echo "<form action='class/delete_grade.php' method='post'>";
        $check = $check + 1;
        //if ($row['filename'] == "No Image") {
        //    $img = "<img src='' style='color:red;' alt='No Image' id='$count2' class='screenshotimg'>";
        //} else {
        //    $img = "<img src='$uploadimg' alt='No Image' id='$count2' class='screenshotimg' onclick='zoom(this.id)'>";
        //}
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
                <tr onclick='collapse()'>
                    <td class='class-grade$count' id='$count' onclick='collapse(this.id)' style='cursor:pointer;' data-label='Grade' style='display:block;'>".$row['grade']."</td>
                    <td class='td$count' data-label='Date' style='display: none; position: absolute;'>".$row['date']."</td>
                    <td class='td$count' data-label='Weighting' style='display: none; position: absolute;'>".$weighting."%"."</td>
                    <td class='td$count' data-label='Description' style='display: none; position: absolute;'>".$row['description']."</td>
                    <td class='td$count' data-label='Screenshots' style='display: none; position: absolute;'>test</td>
                    <td class='td'><button type='submit' id='trash-btn' name='delete_btn'>DELETE</button></td>
                </tr>
            </tbody>
            </table>";
        echo "<input type='text' name='delete_id' value='$id' style='display: none; position: absolute;'>";
        echo "<input type='text' name='delete_grade' value='$grade' style='display: none; position: absolute;'>";
        echo "<input type='text' name='class' value='$class' style='display: none; position: absolute;'>";
        echo "</form>";
        }
}
