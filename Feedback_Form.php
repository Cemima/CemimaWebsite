<?php

$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["subject"]))
 {
  $error .= '<p><label class="text-danger">Subject is required</label></p>';
 }
 else
 {
  $subject = clean_text($_POST["subject"]);
 }
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }
 if($error == '')
 {
  require 'class/class.phpmailer.php';
  $mail = new PHPMailer;
  $mail->IsSMTP();        //Sets Mailer to send message using SMTP
  $mail->Host = 'smtpout.secureserver.net';  //Sets the SMTP hosts
  $mail->Port = '80';        //Sets the default SMTP server port
  $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
  $mail->Username = 'xxxxxxxxxx';     //Sets SMTP username
  $mail->Password = 'xxxxxxxxxx';     //Sets SMTP password
  $mail->SMTPSecure = '';       //Sets connection prefix. Options are "", "ssl" or "tls"
  $mail->From = $_POST["email"];     //Sets the From email address for the message
  $mail->FromName = $_POST["name"];    //Sets the From name of the message
  $mail->AddAddress('Gantzel99@gmail.com', 'Name');//Adds a "To" address
  $mail->AddCC($_POST["email"], $_POST["name"]); //Adds a "Cc" address
  $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
  $mail->IsHTML(true);       //Sets message type to HTML    
  $mail->Subject = $_POST["subject"];    //Sets the Subject of the message
  $mail->Body = $_POST["message"];    //An HTML or plain text message body
  if($mail->Send())        //Send an Email. Return true on success or false on error
  {
   $error = '<label class="text-success">Thank you for contacting us</label>';
  }
  else
  {
   $error = '<label class="text-danger">There is an Error</label>';
  }
  $name = '';
  $email = '';
  $subject = '';
  $message = '';
 }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cemima I/S</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href='https://fonts.googleapis.com/css?family=Amatic SC' rel='stylesheet'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <script src="TrueParallax.js"></script>
  <script src="CollapseNav.js"></script>
  <script src="ScrollSpy.js"></script>
  <script src="SmoothScroll.js"></script>


       
</head>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
              </button>
            <a class="navbar-brand active scroll" href="#Titel">
            <img src="Billeder/logo.png" alt="logo" style="width:40px;">
            </a>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link scroll" href="#Overskrift">Om os</a>
            </li>
            <li class="nav-item">
            <a class="nav-link scroll" href="#bg-Lightblue">Produkter</a>
           </li>
            <li class="nav-item">
            <a class="nav-link scroll" href="#bg-mistyrose2">Hvorfor kørestolsborde?</a>
           </li>
           <li class="nav-item">
            <a class="nav-link scroll" href="#bg-Lightblue2">Statistikker og placering</a>
           </li>
         </ul>
        </div>
        </nav>
      </header>
    <body>

<br />
  <div class="container">
   <div class="row">
    <div class="col-md-8" style="margin:0 auto; float:none;">
     <h3 align="center">Send an Email on Form Submission using PHP with PHPMailer</h3>
     <br />
     <?php echo $error; ?>
    <form action="/feedback_form.php" method="post">
      <div class="form-group">
       <label>Enter Name</label>
       <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
      </div>
      <div class="form-group">
       <label>Enter Email</label>
       <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
      </div>
      <div class="form-group">
       <label>Enter Subject</label>
       <input type="text" name="subject" class="form-control" placeholder="Enter Subject" value="<?php echo $subject; ?>" />
      </div>
      <div class="form-group">
       <label>Enter Message</label>
       <textarea name="message" class="form-control" placeholder="Enter Message"><?php echo $message; ?></textarea>
      </div>
      <div class="form-group" align="center">
       <input type="submit" name="submit" value="Submit" class="btn btn-info" />
      </div>
     </form>
    </div>
   </div>
  </div>
    
    </body>
</html>