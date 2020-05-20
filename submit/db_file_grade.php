<?php
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE IF NOT EXISTS file_grade (
        file_grade_id INTEGER PRIMARY KEY,
        fk_grade INTEGER,
        fk_file INTEGER,
        FOREIGN KEY (fk_grade)
            REFERENCES grade (grade_id),
        FOREIGN KEY (fk_file)
            REFERENCES file (file_id))');
?>