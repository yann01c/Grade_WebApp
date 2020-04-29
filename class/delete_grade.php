<?php
    if(isset($_POST['delete_btn'])) {
        $id = $_POST['delete_id'];
        $grade = $_POST['delete_grade'];
        $userID = $_POST['delete_userID'];
        $class = $_POST['class'];

        $db = new SQLite3('../sqlite/webapp.db');

        $sql = $db->prepare("DELETE FROM grade WHERE grade_id = :id AND fk_user = :user");
        if(!$sql) {
            header("Location: ../class.php?error=sqlerror");
            exit();
        } else {
            $sql->bindValue(':id',$id);
            $sql->bindValue(':user',$userID);
            $result = $sql->execute();
            header("Location: ../class.php?success=$class");
            exit();
        }
    } else { // When accessed manually, send user back to signup page
        header("Location: ../index.php");
        exit();
    }