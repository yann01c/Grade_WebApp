<?php
    $db = new SQLite3('sqlite/webapp.db');

    // Get fk_group ID
    $userID = $_SESSION['userID'];
    $sql = $db->prepare("SELECT fk_group FROM login WHERE user_id = :userid");
    if (!$sql) {
        echo "<p style='color:orange;font-weight:bold;font-size:1.5em;'>SQLite Error 1</p>";
        exit();
    }
    $sql->bindValue(':userid',$userID);
    $r = $sql->execute();
    $fk = $r->fetchArray();
    $fkgroup = $fk['fk_group'];

    // Get all Classes with group_id = $fkgroup
    $sql2 = $db->prepare("SELECT * FROM class WHERE fk_group = :fkg");
    if (!$sql2) {
        echo "<p style='color:orange;font-weight:bold;font-size:1.5em;'>SQLite Error 2</p>";
        exit();
    }
    $sql2->bindValue(':fkg',$fkgroup);
    $result = $sql2->execute();

    $count = 0;
    $i = 0;

    // Select every class in class with the right group id and display it in Table
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        //$btn = "Go to ".$row['class'];
        $count++;
        $class = $row['class'];
        $class_id = $row['class_id'];

        $average = $db->prepare("SELECT * FROM grade WHERE fk_user = :fk_user AND fk_class = :fk_class");
        $average->bindValue('fk_user',$userID);
        $average->bindValue(':fk_class',$class_id);
        $aresult = $average->execute();

        while($arow = $aresult->fetchArray(SQLITE3_ASSOC)) {
            //$w = $arow['weighting'] * 100;
            $i++;
            $newgrades[] = array();
            $newweighting[] = array();
            $newgrades[] = $arow['grade'] * ($arow['weighting'] * 100);
            $newweighting[$i] = ($arow['weighting'] * 100) + ($arow['weighting'] * 100);
        }

        if (empty($newgrades)) {
            $avfinish = "No Grades yet!";
        } else {
            $avweighting = array_sum($newweighting);
            //$avcount = count($newgrades);
            $avgrade = array_sum($newgrades);
            $avfinish = $avgrade / $avweighting;
            unset($avgrades);
            unset($avweighting);
        }

        // Count grades
        $sqlt = $db->prepare("SELECT grade FROM grade WHERE fk_user = :userid AND fk_class = :fkclass");
        $sqlt->bindValue(':userid',$userID);
        $sqlt->bindValue(':fkclass',$class_id);
        $resultt = $sqlt->execute();
        $total = 0;
        while ($rowt = $resultt->fetchArray()) {
                $total += 1;
        }
        //$newgrades[] = array();

        //$i++;
        //$newgrades[$i] =  $arow['grade'] * $arow['weighting'];

        //foreach ($grades as $value) {
        //    $newgrades[] = $value * $arow['weighting'];
        //}

        //$av = array_product($newgrades);

        echo "<form id='form$count' action='class.php' method='GET'>";
        echo "<table>
            <caption></caption>
            <thead>
            <tr>
                <th scope='col'>Class</th>
                <th scope='col'>Total</th>
                <th scope='col'></th>
            </tr>
            </thead>";
        echo "<tbody>
                <tr id='$count' onclick='submit(this.id)' style='cursor:pointer;'>
                    <td data-label='Class' style='font-weight:bolder;'>".$row['class']."</td>
                    <td data-label=''>$total</td>
                </tr>
            </tbody>
            </table>";
        echo "<input type='text' name='c1-class' value='$class' style='display:none;position:absolute;'>";
        echo "</form>";
    }