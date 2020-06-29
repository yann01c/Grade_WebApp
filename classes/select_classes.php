<?php
    $db = new SQLite3('sqlite/webapp.db');

    $userID = $_SESSION['userID'];

    // Get all Classes with group_id = $fkgroup
    $sql2 = $db->prepare("SELECT * FROM class WHERE fk_user = :userid");
    if (!$sql2) {
        header("Location: class.php?error=sql");
        exit();
    }
    $sql2->bindValue(':userid',$userID);
    $result = $sql2->execute();

    $count = 0;

    // Select every class in class with the right group id and display it in Table
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        
        $count++;

        $class = $row['class'];
        $class_id = $row['class_id'];

        // Count grades
        $sqlt = $db->prepare("SELECT grade FROM grade WHERE fk_user = :userid AND fk_class = :fkclass");
        $sqlt->bindValue(':userid',$userID);
        $sqlt->bindValue(':fkclass',$class_id);
        $resultt = $sqlt->execute();

        $total = 0;

        while ($rowt = $resultt->fetchArray()) {
                $total += 1;
        }
        echo "<form id='form$count' action='class.php' method='GET'>";
        echo "<table>
            <caption></caption>
            <thead>
            <tr>
                <th scope='col'>Class</th>
                <th scope='col'></th>
                <th scope='col'>test</th>
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