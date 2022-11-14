<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../Packages/vendor/autoload.php';
session_start();
if (!isset($_SESSION['Admin_Username'])) {
    header("Location: index.php");
} else {



    $to = $_SESSION['Email_to'];
    $from = $_SESSION['Admin_Email'];
    $username = $_SESSION['Admin_Username'];

    // $subject = $_SESSION['Email_subject'];
    // $reply = $_SESSION['Email_reply'];

    $subject = $_POST['subject'];
    $reply = $_POST['reply'];




    $mail = new PHPMailer(true);
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;                    //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'us2.smtp.mailhostbox.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'queries@kongolian.tech';                     //SMTP username
        $mail->Password   = 'YEagpJj7';                               //SMTP password
        $mail->SMTPSecure = false;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('queries@kongolian.tech' , 'Kongolian');
        $mail->addAddress($to, $username);     // Add a recipient
        



        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $reply;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent <br>';
        require_once '../connection.php';
        $db = connect();
        $sql = "SELECT * FROM `Quries` WHERE `email` = '$to'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        // delete the user from the database
        $sql = "DELETE FROM `Quries` WHERE `id` = '$id'";
        $result = mysqli_query($db, $sql);
        echo "Message has been sent and the query has been deleted from the database";
        header("Location: QueryChecker.php");

        
        // redirect to the admin page
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }




    












}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/SE.css">
    <title>Document</title>
</head>
<body>



        <div class="col-md-12">
            <a href="QueryChecker.php" class="btn btn-primary">Return back to quries</a>
        </div>
    
</body>
</html>








