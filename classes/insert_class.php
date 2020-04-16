<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($_POST as $class) {
            echo("Class added!");
        }
    $db = new SQLite3('webapp.db');
    $db->exec('INSERT INTO class (class) VALUES ($class)');
}
?>