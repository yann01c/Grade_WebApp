<?php
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE IF NOT EXISTS file (
        file_id INTEGER PRIMARY KEY,
        filename TEXT,
        fk_user INTEGER,
        FOREIGN KEY (fk_user)
            REFERENCES login (user_id))');
?>