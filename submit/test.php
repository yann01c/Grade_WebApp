<?php
if (isset($_FILES['fileToUpload'])) {
    $target_dir = "../upload/";
    $filetype = $_FILES['fileToUpload']['type'];
    $filesize = $_FILES['fileToUpload']['size'];
    $file = $_FILES['fileToUpload']['name'];
    $temp_name = $_FILES['fileToUpload']['tmp_name'];
    echo "ERROR = ".$_FILES['fileToUpload']['error'];

    $path = pathinfo($file);
    $filename = $path['filename'];
    $ext = $path['extension'];
    $path_filename_ext = $target_dir.$filename.".".$ext;

    // Check if file already exists
    if (file_exists($path_filename_ext)) {
        echo "Sorry, file already exists.";
    } else {
        move_uploaded_file($temp_name,$path_filename_ext);
        echo "TEMP = ".$temp_name;
        echo "PATH = ".$path_filename_ext;
        echo "<img src='../upload/$filename' alt='lmao' style='width:200px;height:200px'/>";
    }
}