<?php
    $db = new SQLite3('sqlite/webapp.db');

    $result = $db->query('select * from class');

    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        echo "<option value=".$row['class']."id='class'>".$row['class']."</option>";
    }
?>