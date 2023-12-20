
<?php 
use PHPMailer\PHPMailer\PHPMailer;
error_reporting(0); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contact Form</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body{
                margin: 20px 0;
                background: #ccc;
            }

            form{
                background: #fff;
                padding: 25px;
            }
        </style>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <form action="" method="post">
                        <h3>Contact form</h3>
                        <?php
                        require("vendor/autoload.php");
                        if (isset($_POST['email'])) {

                            $email = $_POST['email'];
                            $subject = $_POST['subject'];
                            $query = $_POST['query'];

                            $mail = new PHPMailer();
                            $mail->IsSMTP();
                            $mail->Host = "smtp.gmail.com"; // Enter your host here
                            $mail->SMTPAuth = true;
                            $mail->Username = "email"; // Enter your email here
                            $mail->Password = "password"; //Enter your passwrod here
                            $mail->SMTPSecure = 'TLS';
                            $mail->Port = 587;
                            $mail->IsHTML(true);
                            $mail->From = "sachinyadav.3999@gmail.com";
                            $mail->FromName = "sachin";

                            $mail->Subject = $subject;

                            $message = file_get_contents('templete.php');
                            $message = str_replace('%subject%', $subject, $message);
                            $message = str_replace('%message%', $query, $message);
                            $mail->msgHTML($message);
                            $mail->AddAddress($email);
                            $mail->AddAddress('sachinyadav.3999@gmail.com'); //admin email
                            if (!$mail->Send()) {
                                echo "Mailer Error: " . $mail->ErrorInfo;
                            } else {
                                header("Location:thanks.php");
                            }
                        }
                        ?>
                        <div class="form-group">
                            <label for="subject">Subject:</label> 
                            <input type="text" name="subject" id="subject" maxlength="255" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Your email address:</label> 
                            <input type="email" name="email" id="email" maxlength="255" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="query">Your question:</label>
                            <textarea cols="30" rows="8" name="query" id="query" placeholder="Your question" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

    </body>
</html>
