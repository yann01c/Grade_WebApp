<?php
    $db = new SQLite3('sqlite/webapp.db');
    include 'submit/db_grade.php';
    include 'classes/db_classes.php';
    include 'login/db_login.php';
    include 'login/db_token.php';
    include 'group/db_group.php';
    include 'submit/db_file.php';
    include 'submit/db_file_grade.php';
?>