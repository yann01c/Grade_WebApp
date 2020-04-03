<?php 
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE IF NOT EXISTS grade (grade_id INTEGER PRIMARY KEY,grade FLOAT,date DATE,weighting INTEGER,description TEXT,average FLOAT)');
?>