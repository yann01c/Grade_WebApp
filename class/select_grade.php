<?php
    $db = new SQLite3('sqlite/webapp.db');

    $result = $db->query('select * from grade');

    // Select every grade in grade and display it in "option" element in HTML
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        echo "<option value=".$row['grade'].">".$row['grade']."</option>";
    }
?>