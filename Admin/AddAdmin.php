<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quries</title>
</head>
<body>


    <?php 
        $answer = "";

        require_once '../connection.php';
        $db = connect();

        $username = "";
        $email = "";
        $password = "";
        $password = password_hash($password, PASSWORD_DEFAULT);
        $role = "staff";

 

            // $sql = "INSERT INTO staff (username, password, role, email) VALUES ('$username', '$password', '$role', '$email')";
        $result = $db->query($sql);
        if ($result) {
            $answer = "Success";
        } else {
            $answer = "Failed";
        }


    ?>


    <h2 class="confirmation">
        <?php
            echo $answer;
        ?>
    </h2>
    
</body>
</html>