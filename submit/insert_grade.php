<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['submit'])) {
        $grade = $_POST['s_grade'];
        $date = $_POST['s_date'];
        $weighting = $_POST['s_weighting'];
        $description = $_POST['s_description'];
        $class = $_POST['s_class'];

        // File Vars
        $target_dir = "upload/";
        $filetype = $_FILES['fileToUpload']['type'];
        $filesize = $_FILES['fileToUpload']['size'];
        $file = $_FILES['fileToUpload']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['fileToUpload']['tmp_name'];
        $path_filename_ext = $target_dir.$filename.".".$ext;
        $maxSize = 0;

        if (empty($grade) || empty($date) || empty($weighting)) {
            echo "<p style='color:red;font-weight:bold;font-size:1.2em;'>Empty!</p>";
            exit();
        }
        else if ($weighting > 2.0 || $weighting < 0) {
            echo "<p style='color:red;font-weight:bold;font-size:1.2em;'>Weighting Invalid!</p>";
            exit();
        }
        else if ($grade > 6.0 || $grade < 0) {
            echo "<p style='color:red;font-weight:bold;font-size:1.2em;'>Grade Invalid!</p>";
            exit();
        }

        if (empty($_FILES['fileToUpload'])) {
            // Check file extension
            if ($ext != "jpg" && $ext != "jpeg") {
                echo "<p style='color:red;font-weight:bold;font-size:1.2em;'>Extension Invalid!</p>";
                exit();
            }
            // Check if file already exists
            if (file_exists($path_filename_ext)) {
                echo "<p style='color:blue;font-weight:bold;font-size:1.2em;'>File already exists!</p>";
                exit();
            } else {
                move_uploaded_file($temp_name,$path_filename_ext);
                chmod($path_filename_ext, 0755);
                echo "FILENAME = ".$filename;
                echo "TEMP = ".$temp_name;
                echo "PATH = ".$path_filename_ext;
                echo "FILE UPLOADED";
            }
        } else {
            $db = new SQLite3('sqlite/webapp.db');

            $sql = $db->prepare("SELECT class_id from class WHERE class='$class'");
            $r = $sql->execute();
            $row = $r->fetchArray();
            $fkclass = $row['class_id'];
            $userID = $_SESSION['userID'];
            $sqlg = $db->prepare("INSERT INTO grade (grade,date,weighting,description,filename,fk_class,fk_user) VALUES (:grade,:date,:weighting,:des,:file,:fkclass,:userid)");
            if (!$sql) {
                echo "<p style='color:orange;font-weight:bold;'>SQLite Error</p>";
                exit();
            } else {
                $sqlg->bindValue(':grade',$grade);
                $sqlg->bindValue(':date',$date);
                $sqlg->bindValue(':weighting',$weighting);
                $sqlg->bindValue(':des',$description);
                $sqlg->bindValue(':file',$file);
                $sqlg->bindValue(':fkclass',$fkclass);
                $sqlg->bindValue(':userid',$userID);
    
                $result = $sqlg->execute();
                echo "<p style='color:green;font-weight:bold;'>Successfully Submitted Grade!</p>";
                exit();
            }
        }
    }
}