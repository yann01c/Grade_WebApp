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
    $sqlfk = $db->prepare("SELECT * FROM class WHERE class = :class AND fk_user = :user");
    // If statement runs into an error
    if (!$sqlfk) {
        header("Location: class.php?error=sql");
        exit();
    }

    // Bind & Execute
    $sqlfk->bindValue(':class',$class);
    $sqlfk->bindValue(':user',$userID);
    $r = $sqlfk->execute();
    $rr = $r->fetchArray();
    $fkclass = $rr['class_id'];

    // Prepare SELECT statement for table "grade"
    $sql = $db->prepare("SELECT * FROM grade WHERE fk_user = :userid AND fk_class = :fkclass");
    // If statement runs into an error
    if (!$sql) {
        header("Location: class.php?error=sql");
        exit();
    }
    // Bind & Execute
    $sql->bindValue(':userid',$userID);
    $sql->bindValue(':fkclass',$fkclass);
    $result = $sql->execute();

    // Count / Check vars
    $count = 0;
    $imgcheck = 0;

    // Select grades
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        $grade_id = $row['grade_id'];
        $wfile = $row['weighting'] * 100;
        $i = 0;

        // Prepare SELECT statement for file_grade
        $sqlfilegrade = $db->prepare("SELECT fk_file FROM file_grade WHERE fk_grade = :file_grade");
        $sqlfilegrade->bindValue(':file_grade',$grade_id);
        $rfg = $sqlfilegrade->execute();

        $downloadpath = "download/summary$grade_id$userID.csv";

        if (!file_exists($downloadpath)) {
            $myfile = fopen("download/summary$grade_id$userID.csv", "w");
            $txt = "ID: ".$grade_id." | GRADE: ".$row['grade']." | WEIGHTING: ".$wfile."%"." | DATE: ".$row['date']." | DESCRIPTION: ".$row['description']." | CLASS: ".$class." | USER: ".$_SESSION['userUID'];        
            fwrite($myfile, $txt);
            fclose($myfile);
        }

        $image[] = array();

        while($afg = $rfg->fetchArray(SQLITE3_ASSOC)) {
            $imgcheck = 1;

            $imgid = $afg['fk_file'];

            $sqlfile = $db->prepare("SELECT * FROM file WHERE file_id = :fk_file");
            $sqlfile->bindValue(':fk_file',$imgid);
            $res = $sqlfile->execute();
            $filea = $res->fetchArray();

            $i++;

            // Array error fix
            if (empty($filea['filename']) || $filea['filename'] == "No Image!") {
                $path = "";
            } else {
                $path = $filea['filename'];
            }
    
            if (empty($filea['filename']) || $filea['filename'] == "No Image!") {
                $imgcheck = 0;
            } else {
                $imgstyle = "<style>#$imgid:hover { translate: scale(1.2);}</style>";
                $image[$i] = "<img src='$path' class='small-image' id='$imgid' style='width:30px;height:30px;margin-left:10px;cursor:pointer;' onclick='zoom(this.id)' alt='No Image'>";
            }

            // Input with path value (used for zoom.js ZOOM function)
            echo "<input id='imginput$imgid' value='$path' style='display:none;position:absolute;'>";
        }
        
        $a = $i;
    
        // Grade greater or equal to 5.0 gets color GREEN
        if ($row['grade'] >= 5.0) {
            $color = 'green';
            $count = $count + 1;
        }
        // Grade greater or equal to 4.0 gets color ORANGE
        else if ($row['grade'] >= 4.0 && $row['grade'] <= 4.9) {
            $color = '#ff8c00';
            $count = $count + 2;
        }
        // Grade smaller or equal to 3.9 gets color ORANGE
        else if ($row['grade'] <= 3.9) {
            $color = '#BF0413';
            $count = $count + 3;
        }

        // Set vars
        $id = $row['grade_id'];
        $grade = $row['grade'];
        $weighting = $row['weighting'] * 100;
        $userID = $_SESSION['userID'];

        if (empty($row['timestamp'])) {
            $timestamp = "-";
        } else {
            $timestamp = $row['timestamp'];
        }

        $style = '<style type="text/css">.class-grade'.$count.'{color:'.$color.'; font-weight: bold;}</style>';
        echo $style;

        // Echo tables with content
        echo "<form action='class/delete_grade.php' method='post'>";
        echo "<table>
            <caption sytle='color:white;'></caption>
            <thead>
            <tr>
                <th scope='col'>Grade</th>
                <th scope='col'>Date</th>
                <th scope='col'>Weighting</th>
                <th scope='col'>Description</th>
                <th scope='col'>Screenshots</th>
                <th scope='col'>Created</th>
                <th scope='col'></th>
            </tr>
            </thead>";
        echo "<tbody>
                <tr onclick='collapse()'>
                    <td class='class-grade$count' id='$count' onclick='collapse(this.id)' style='cursor:pointer;display:block;color: $color;' data-label='Grade'>".$row['grade']."</td>
                    <td class='td$count' data-label='Date' style='display: none; position: absolute;'>".$row['date']."</td>
                    <td class='td$count' data-label='Weighting' style='display: none; position: absolute;'>".$weighting."%"."</td>
                    <td class='td$count' data-label='Description' style='display: none; position: absolute;'>".$timestamp."</td>
                    <td class='td$count' data-label='Screenshots' style='display: none; position: absolute;'>"; if ($imgcheck == 0) {
                        echo "-";
                    } else {
                        for ($i = 1; $i <= $a ; $i++) {
                            echo $imgstyle;
                            echo $image[$i];
                        }
                    }
                    echo "</td><td class='td$count' data-label='Created' style='display: none; position: absolute;'>".$row['timestamp']."</td>
                    <td class='td'><a class='download-btn' href='$downloadpath' download>DOWNLOAD</a><button type='submit' class='trash-btn' name='delete_btn'>🗑️</button></td>
                </tr>
            </tbody>
            </table>";
        echo "<input type='text' name='delete_id' value='$id' style='display: none; position: absolute;'>";
        echo "<input type='text' name='delete_grade' value='$grade' style='display: none; position: absolute;'>";
        echo "<input type='text' name='class' value='$class' style='display: none; position: absolute;'>";
        echo "</form>";
        }
}
