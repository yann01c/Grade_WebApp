<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['c1-class'])) {
        $class = $_POST['c1-class'];
        echo $class;
    }
}
?>