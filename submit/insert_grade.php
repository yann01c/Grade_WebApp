<?php
if(isset($_POST['submit'])) {
    $grade = $_POST['s_grade'];
    $date = $_POST['s_date'];
    $weighting = $_POST['s_weighting'];
    $description = $_POST['s_description'];
    $class = $_POST['s_class'];

    if( isset($_FILES['fileToUpload']['name'])) { 
        $total_files = count($_FILES['fileToUpload']['name']);
        echo $total_files;
    }
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
        $file = "Kein Bild";
    } else {
        // File Vars
        $target_dir = "upload/";
        for($i=0;$i<$total_files;$i++) {
            $filetype = $_FILES['fileToUpload']['type'][$i];
            $filesize = $_FILES['fileToUpload']['size'][$i];
            $file = $_FILES['fileToUpload']['name'][$i];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['fileToUpload']['tmp_name'][$i];
            $path_filename_ext = $target_dir.$filename.".".$ext;
            $maxSize = 0;
            // Check if extension is = JPG or JPEG
            if ($ext != "jpg" && $ext != "jpeg") {
                echo "<p style='color:red;font-weight:bold;font-size:1.2em;'>Extension Invalid!</p>";
                exit();
            }
            // Check if file already exists
            if (file_exists($path_filename_ext)) {
                echo "<p style='color:blue;font-weight:bold;font-size:1.2em;'>File already exists!</p>";
                exit();
            }
            move_uploaded_file($temp_name,$path_filename_ext);
            chmod($path_filename_ext, 0755);
            echo "FILENAME = ".$filename;
            echo "TEMP = ".$temp_name;
            echo "PATH = ".$path_filename_ext;
            echo "FILE UPLOADED";
        }
    }
    
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
        echo "FILE = ".$file;
        if (empty($file)) {
            $file = "Kein Bild";
        } else {
            $file = $filename.".".$ext;
        }
        $sqlg->bindValue(':file',$file);
        $sqlg->bindValue(':fkclass',$fkclass);
        $sqlg->bindValue(':userid',$userID);

        $result = $sqlg->execute();
        echo "<div class='submitteddiv' style='width:100%;display:flex;justify-content:center;position:absolute;color:lightgreen;font-weight:bold;font-family:'Iceland',cursive;font-size:1.3em;'><p style='color:green;font-weight:bold;position:relative;'>Successfully Submitted Grade!</p>";
        exit();
    }
}
