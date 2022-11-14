<?php

// get the username of staff
session_start();
$username = $_SESSION['Admin_Username'];
if (isset($_POST['submit'])) {
    // check if a file is selected
    if (isset($_FILES['file'])) {
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileError = $_FILES['file']['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        // check if the file type is allowed
        if (in_array($fileActualExt, $allowed)) {
            // check if the file size is less than 5MB
            if ($fileSize < 5000000) {
                // check if the file error is equal to 0
                if ($fileError === 0) {
                    // create a new file name
                    $fileNewName = $username . "." . $fileActualExt;
                    // create a new file path
                    // $filePath = '/pfp/' ;
                    $fileRoot = 'pfp/';
                    $fileDestination = 'pfp/' . $fileNewName;

                    // move the file to the new file path
                    move_uploaded_file($fileTmpName, $fileRoot);

                    // echo "File uploaded successfully";
                    echo "<img src='$fileDestination' alt='$fileName'> <br>";

                    echo "<a href='$fileDestination'>$fileName</a> <br>";
                    echo "<p>$username</p>";



                } else {
                    echo "There was an error uploading your file!";
                }
            } else {
                echo "Your file is too big!";
            } 
        } else {
            echo "You cannot upload files of this type!";
        }
    } else {
        echo "You have not selected a file!";
    }




}


?>