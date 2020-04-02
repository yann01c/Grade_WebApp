<?php 
    $db = new SQLite3('grades.db');
    $db->exec('CREATE TABLE IF NOT EXISTS grades (s_class VARCHAR(255),s_grade FLOAT,s_date DATE,s_weighting INTEGER,s_description TEXT)');
?>
    
    