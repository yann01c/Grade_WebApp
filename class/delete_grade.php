<?php
    session_start();

    if(isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
	$class = $_POST['class'];

        $userID = $_SESSION['userID'];

        $db = new SQLite3('../sqlite/webapp.db');

        $sql = $db->prepare("DELETE FROM grade WHERE grade_id = :id AND fk_user = :user");
        if(!$sql) {
            header("Location: ../class.php?error=sqlerror");
            exit();
        } else {
            $sql->bindValue(':id',$id);
            $sql->bindValue(':user',$userID);
            $result = $sql->execute();
	    header("Location: ../class.php?c1-class=$class");
            exit();
        }
    } else { // When accessed manually, send user back to signup page
        header("Location: ../index.php");
        exit();
    }
