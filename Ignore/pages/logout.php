<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website Icon -->
    <link rel="icon" href="../assets/images/Icon8.png">

    <title>Document</title>
</head>
<body>
    
<!-- logout the account -->
<?php
    session_start();
    session_destroy();
    header("Location: ../index.php");
?>



</body>
</html>