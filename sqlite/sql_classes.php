<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['newclass'])) {
        $class = $_POST['newclass'];
    }
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('INSERT INTO class (class) VALUES ($class)');
}
?>