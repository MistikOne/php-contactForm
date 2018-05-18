<?php
    //Message variables
    $msg = "";
    $msgClass = "";
    //check for submit
    if(filter_has_var(INPUT_POST, "submit")){
        //Test: echo "Submitted!";
        //get the data from the form
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $message = htmlspecialchars($_POST["message"]);

        //Check required fields
        //if the felds are not empty
        if(!empty($name) && !empty($email) && !empty($message)){
            //passed
            //Test: echo "Passed!";
            //check email
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE ){
                //failed 
                $msg = "Please enter correct email.";
                $msgClass = "alert-danger";
            } else {
                //passed
                // echo "Passed!";
                //set up recipient email
                $toEmail = "milan.webdeveloper@gmail.com";
                //email subject
                $subject = "Contact Request From" .$name;
                //email body
                $body = "<h2>Contact Request</h2>
                        <h5>Name: <h5><p>".$name."</p>
                        <h5>Email: <h5><p>".$email."</p>
                        <h5>Message: <h5><p>".$message."</p>";

                //email headers
                $headers = "MIME-Version 1.0" ."\r\n";
                $headers .=  "Content-Type:text/html; charset=UTF-8" . "\r\n";

                //additional header //from
                $headers .= "From: " .$name. "<" .$email. ">". "\r\n";
                //mail function
                if(mail($toEmail, $subject, $body, $headers)){
                    //email Sent
                    $msg = "Your email has been sent.";
                    $msgClass = "alert-success";
                } else {
                    //email failed
                    $msg = "Your Email was not sent.";
                    $msgClass = "alert-danger";
                }
            }
        } else {
            //failed
            $msg = "Please fill in all fields.";
            $msgClass = "alert-danger";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootswatch stylesheet -->
     <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    <title>Contact Us</title>
</head>
<body>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
            <a class="navbar-brand" href="contact.php">Contact</a>
            </div>
        </div>
    </nav>

    <div class="container">

        <!-- Test for Message -->
        <?php if($msg != ""):  ?>
            <div class="alert <?php echo $msgClass;?>">
            <?php echo $msg ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo isset($_POST["name"]) ? $name : "" ?>" placeholder="Name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php  echo isset($_POST["email"]) ? $email : "" ?>" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" class="form-control" value="" placeholder="Write your message here..."><?php echo isset($_POST["message"]) ? $message : "" ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-info">Submit</button>
        </form>
    </div>
</body>
</html>