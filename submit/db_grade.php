<?php
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE IF NOT EXISTS grade (
        grade_id INTEGER PRIMARY KEY,
        grade FLOAT,
        date DATE,
        weighting INTEGER,
        description TEXT,
        timestamp DATE,
        fk_user INTEGER,
        fk_class INTEGER,
        FOREIGN KEY (fk_user)
            REFERENCES login (user_id),
        FOREIGN KEY (fk_class)
            REFERENCES class (class_id))');
?>